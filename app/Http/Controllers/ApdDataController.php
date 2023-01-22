<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Eapd\ApdList;
use App\Models\Eapd\InputApdTemplate;
use App\Models\Eapd\Jabatan;
use App\Enum\VerifikasiApd as verif;
use App\Enum\StatusApd as status;
use App\Models\Eapd\ApdJenis;
use App\Models\Eapd\InputApd;
use App\Models\Eapd\Pegawai;
use Error;
use Throwable;

/**
 * Kontroller yang membantu mengatur masukan data input user ke db dan keluaran data input untuk ditampilkan di berbagai komponen aplikasi web
 */
class ApdDataController extends Controller
{

    /**
     * @var int Berapa banyak gambar yang dapat diupload oleh user dan admin
     */
    public static $jumlahBatasUploadGambar = 3;

    /**
     * Digunakan untuk contoh, muat mock list untuk digunakan sebagai template inputan
     * @param string $id_jenis jenis apd yang akan digunakan
     * @return array opsi apd yang dicari dari template contoh
     */
    public function muatContohDaftarInputApd(string $id_jenis): array
    {
        // digunakan untuk contoh
        $list = [
            ['id_jenis' => 'H002', 'opsi_apd' => ['H-fir-0001']],
            ['id_jenis' => 'H001', 'opsi_apd' => ['H-bro-0000', 'H-fir-0000', 'H-bro-0001']],
            ['id_jenis' => 'G001', 'opsi_apd' => ['G-glo-0000', 'G-glo-0001', 'G-alt-0000']],
            ['id_jenis' => 'G002', 'opsi_apd' => ['G-alt-0001', 'G-alt-0002']],
            ['id_jenis' => 'T001', 'opsi_apd' => ['T-fir-0000', 'T-pol-0000']],
            ['id_jenis' => 'T002', 'opsi_apd' => ['T-yoh-0000', 'T-pol-0001']],
            ['id_jenis' => 'B001', 'opsi_apd' => ['B-yoh-0000', 'B-ari-0000']],
            ['id_jenis' => 'B002', 'opsi_apd' => ['B-ari-0001']],
            ['id_jenis' => 'A001', 'opsi_apd' => ['A-dar-0000']],
            ['id_jenis' => 'A002', 'opsi_apd' => ['A-ari-0000']],
            ['id_jenis' => 'A003', 'opsi_apd' => ['A-tho-0000']],
            ['id_jenis' => 'A004', 'opsi_apd' => ['A-uni-0000']],
        ];

        $index = array_search($id_jenis, array_column($list, 'id_jenis'));

        // error_log('id_jenis ApdDataController : ' . $id_jenis);
        // error_log('index list dari id_jenis ApdDataController : ' . $index);

        return $list[$index];
    }

    /**
     * Buat satu item dari untuk list contoh template
     */
    public function muatSatuContohDaftarInputApd(): array
    {
        return ['id_jenis' => 'H001', 'opsi_apd' => ['H-bro-0000', 'H-fir-0000', 'H-bro-0001']];
    }

    public function muatOpsiApd(string $id_jenis, $id_periode = 1, $id_jabatan = "")
    {
        try{

            $list = $this->muatListInputApdDariTemplate($id_periode,$id_jabatan);
            $index = array_search($id_jenis, array_column($list, 'id_jenis'));
            return $list[$index];

        }
        catch(Throwable $e)
        {
            error_log('Gagal memuat daftar input apd '.$e);
        }
    }

    /**
     * Ambil template untuk input apd dari database berdasarkan periode dan jabatan
     * @param int $id_periode periode untuk template yang dicari, dalam bentuk id periode
     * @param string $id_jabatan jabatan untuk template yang dicari, dalam bentuk id jabatan
     */
    public function muatListInputApdDariTemplate($id_periode = 1, $id_jabatan = "")
    {
        try {

            // jika parameter jabatan tidak diisi, maka ambil jabatan user
            if ($id_jabatan == "") {
                $id_jabatan = Auth::user()->data->id_jabatan;
            }

            // ambil template penginputan apd dari database menggunakan pivot table yang telah di buat di model
            if($list = Jabatan::where('id_jabatan', '=', $id_jabatan)->first()->templatePadaPeriode($id_periode)->first()->template)
            {
                // return dd($list);
                return $list;
            }
            else
                return [];

        } catch (Throwable $e) {
            error_log('gagal memuat list template input ');
            return [];
        }
    }

    /**
     * Muat apa saja yang telah diinput oleh pegawai pada periode yang dicari
     * @param int $id_periode periode yang dicari, dalam bentuk id periode
     * @param string $id_pegawai pegawai yang dicari, dalam bentuk id pegawai
     * @param int $target_verifikasi jika ada status verifikasi yang dicari, masukan value dari enum /App/Enum/VerifikasiApd.php atau integer 1~5
     * @return array list apa saja yang telah diinput oleh pegawai, di dapat dari tabel input_apd
     */
    public function muatInputanPegawai($id_periode = 1, $id_pegawai = "", $target_verifikasi = 0): array
    {
        try {

            // jika parameter id_pegawai kosong, ambil nrk dan jabatan user
            if ($id_pegawai == "") {
                $id_pegawai = Auth::user()->userid;
                $id_jabatan = Auth::user()->data->id_jabatan;
            }
            // jika paramter id_pegawai diisi, cukup ambil jabatan user
            else {
                $id_jabatan = Pegawai::where('id', '=', $id_pegawai)->first()->id_jabatan;
            }

            // array kosong untuk return
            $list = [];

            // ambil template dari database
            $template = $this->muatListInputApdDariTemplate($id_periode, $id_jabatan);


            // pengulangan untuk mengisi $list berdasarkan template yang telah diambil
            foreach ($template as $item) {
                // apa tipe apdnya
                $id_jenis = $item['id_jenis'];

                // cek apakah user telah menginput apd tersebut
                if ($input = InputApd::where('id_pegawai', '=', $id_pegawai)->where('id_jenis', '=', $id_jenis)->where('id_periode', '=', $id_periode)->first()) {
                    // user telah menginput

                    // panggil untuk mambantu mengubah warna status
                    $sdc = new StatusDisplayController;

                    // apakah ada status verifikasi yang dicari?
                    if ($target_verifikasi != 0) {
                        // ada status verifikasi tertentu yang dicari

                        // apakah inputan user memiliki verifikasi yang sesuai
                        if (verif::tryFrom($input->verifikasi_status)->value == $target_verifikasi) {
                            // inputan user memiliki verifikasi yang dicari

                            $verifikasi_status = "";
                            $verifikasi_label = "";

                            $this->ekstrakStatusVerifikasi(verif::tryFrom($input->verifikasi_status), $verifikasi_label, $verifikasi_status);

                            // masukan ke $list
                            array_push($list, [
                                'id_jenis' => $id_jenis,
                                'nama_jenis' => ApdJenis::where('id_jenis', '=', $id_jenis)->first()->nama_jenis,
                                'id_apd' => $input->id_apd,
                                'gambar_apd' => $this->siapkanGambarInputanBesertaPathnya($input->image, $id_pegawai, $id_jenis, $id_periode),
                                'status_verifikasi' => $verifikasi_label,
                                'warna_verifikasi' => $sdc->ubahVerifikasiApdKeWarnaBootstrap($verifikasi_status),
                                'status_kerusakan' => $this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode),
                                'warna_kerusakan' => $sdc->ubahKondisiApdKeWarnaBootstrap($this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)),
                                'komentar_pengupload' => $input->komentar_pengupload,
                                'nrk_verifikator' => $input->verifikasi_oleh,
                                'komentar_verifikator' => $input->komentar_verifikator


                            ]);
                        }
                    } else {
                        // tidak ada status verifikasi tertentu yang dicari

                        $verifikasi_status = "";
                        $verifikasi_label = "";

                        $this->ekstrakStatusVerifikasi(verif::tryFrom($input->verifikasi_status), $verifikasi_label, $verifikasi_status);

                        // masukan ke $list
                        array_push($list, [
                            'id_jenis' => $id_jenis,
                            'nama_jenis' => ApdJenis::where('id_jenis', '=', $id_jenis)->first()->nama_jenis,
                            'id_apd' => $input->id_apd,
                            'gambar_apd' => $this->siapkanGambarInputanBesertaPathnya($input->image, $id_pegawai, $id_jenis, $id_periode),
                            'status_verifikasi' => $verifikasi_label,
                            'warna_verifikasi' => $sdc->ubahVerifikasiApdKeWarnaBootstrap($verifikasi_status),
                            'status_kerusakan' => $this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)->label,
                            'warna_kerusakan' => $sdc->ubahKondisiApdKeWarnaBootstrap($this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)),
                            'komentar_pengupload' => $input->komentar_pengupload,
                            'nrk_verifikator' => $input->verifikasi_oleh,
                            'komentar_verifikator' => $input->komentar_verifikator


                        ]);
                    }
                }
            }

            // berikan daftar yang telah diisi dari pengulangan
            return $list;
        } catch (Throwable $e) {
            error_log('Gagal memuat status verifikasi dari list input apd ' . $e);
            return [];
        }
    }

    public function muatSatuInputanPegawai($id_jenis, $id_apd, $id_periode = 1, $id_pegawai = "")
    {
        try{

            // jika parameter nrk kosong, ambil nrk dan jabatan user
            if ($id_pegawai == "") {
                $id_pegawai = Auth::user()->userid;
                $id_jabatan = Auth::user()->data->id_jabatan;
            }
            // jika paramter nrk diisi, cukup ambil jabatan user
            else {
                $id_jabatan = Pegawai::where('id', '=', $id_pegawai)->first()->id_jabatan;
            }

            // cek apakah user telah menginput apd tersebut
            if ($input = InputApd::where('id_pegawai', '=', $id_pegawai)->where('id_jenis', '=', $id_jenis)->where('id_apd','=',$id_apd)->where('id_periode', '=', $id_periode)->first())
            {
                $verifikasi_status = "";
                $verifikasi_label = "";

                $this->ekstrakStatusVerifikasi(verif::tryFrom($input->verifikasi_status), $verifikasi_label, $verifikasi_status);
                
                // panggil untuk mambantu mengubah warna status
                $sdc = new StatusDisplayController;

                return [
                            'id_jenis' => $id_jenis,
                            'nama_jenis' => ApdJenis::where('id_jenis', '=', $id_jenis)->first()->nama_jenis,
                            'id_apd' => $input->id_apd,
                            'gambar_apd' => $this->siapkanGambarInputanBesertaPathnya($input->image, $id_pegawai, $id_jenis, $id_periode),
                            'status_verifikasi' => $verifikasi_label,
                            'warna_verifikasi' => $sdc->ubahVerifikasiApdKeWarnaBootstrap($verifikasi_status),
                            'status_kerusakan' => $this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)->label,
                            'warna_kerusakan' => $sdc->ubahKondisiApdKeWarnaBootstrap($this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)),
                            'komentar_pengupload' => $input->komentar_pengupload,
                            'nrk_verifikator' => $input->verifikasi_oleh,
                            'komentar_verifikator' => $input->komentar_verifikator
                        ];
            }

        }
        catch(Throwable $e)
        {

        }
    }

    public function hitungCapaianInputSektor($sektor, int|array &$maks, int|array &$capaian,$id_periode = 1, $target_verifikasi = 0)
    {
        try{

            // ambil daftar seluruh pegawai di sektor (termasuk staff dan kasie sektor)
            $array_pegawai = Pegawai::where('id_penempatan','like',$sektor.'%')->get();

            // siapkan array untuk proses penghitungan
            $yang_harus_diinput = 0;
            $yang_telah_diinput = 0;

            // menghitung apa yg harus diinput dan apa yang telah diinput oleh tiap pegawai
            foreach($array_pegawai as $pegawai)
            {
                // ambil apa saja yang harus diinput oleh pegawai
                $template =  $this->muatListInputApdDariTemplate($id_periode,$pegawai->id_jabatan);


                // apakah template kosong? (tidak ada yang perlu diinput oleh pegawai tersebut)
                if(!(is_null($template)))
                {
                    // template tidak kosong (ada yang perlu diinput oleh pegawai tersebut)

                    // query apa saja yang perlu diinput oleh pegawai tersebut
                    foreach($template as $t)
                    {
                        $yang_harus_diinput++;

                    }

                    // muat apa saja yang telah diinput oleh si pegawai
                    $inputan = $this->muatInputanPegawai($id_periode,$pegawai->id,$target_verifikasi);

                    // apakah pegawai pernah menginput
                    if(is_array($inputan) && count($inputan) !== 0)
                    {

                        // pegawai pernah menginput

                        // query apa saja yang telah diinput oleh pegawai tersebut
                        foreach($inputan as $i)
                        {
                            if($target_verifikasi != 0)
                            {
                                if($i['status_verifikasi'] == verif::tryFrom($target_verifikasi)->label)
                                {
                                    $yang_telah_diinput++;   
                                    error_log('terinput sekarang '.$yang_telah_diinput);

                                }
                            }
                            else
                                $yang_telah_diinput++;

                        }

                    }

                }
            }


            $maks = $yang_harus_diinput;
            $capaian = $yang_telah_diinput;

        }
        catch(Throwable $e)
        {
            error_log('Gagal menghitung capaian input sektor '.$sektor.' '.$e);
            $maks = 0;
            $capaian = 0;
        }
    }

    /**
     * Bangun list yang akan digunakan untuk thumbnail di halaman apdku.
     * @param int $id_periode periode yang dicari, dalam bentuk id periode
     * @param string $id_jabatan jabatan yang dicari, dalam bentuk id jabatan
     * @return array|string apa saja yang akan ditampilkan untuk thumbnail
     */
    public function bangunListInputApdDariTemplate($id_periode = 1, $id_jabatan = "")
    {
        try {

            // jika parameter jabatan tidak diisi, maka ambil jabatan user
            if ($id_jabatan == "") {
                $id_jabatan = Auth::user()->data->id_jabatan;
            }

            // ambil template input apd dari database berdasarkan pivot table yang telah dibuat di model
            $list = Jabatan::where('id_jabatan', '=', $id_jabatan)->first()->templatePadaPeriode($id_periode)->first()->template;

            // panggil controller untuk membantu menampilkan status di bootstrap
            $sdc = new StatusDisplayController;

            // array kosong untuk di return
            $template = [];

            // pengulangan untuk mengisi template beserta isinya yang akan ditampilkan
            foreach ($list as $item) {

                $statusVerifikasi = $this->ambilStatusVerifikasi($item['id_jenis'], "", $id_periode);
                $warnaVerifikasi = $sdc->ubahVerifikasiApdKeWarnaBootstrap($statusVerifikasi->value);
                $statusKerusakan = $this->ambilStatusKerusakan($item['id_jenis'], "", $id_periode);
                $warnaKerusakan = $sdc->ubahKondisiApdKeWarnaBootstrap($statusKerusakan);
                $nama_jenis = ApdJenis::where('id_jenis', '=', $item['id_jenis'])->first()->nama_jenis;

                array_push($template, [
                    'id_jenis' => $item['id_jenis'],
                    'nama_jenis' => $nama_jenis,
                    'gambar_thumbnail' => $this->ambilGambarPertamaUntukThumbnail($item['id_jenis'], $item['opsi_apd']),
                    'status_verifikasi' => $statusVerifikasi->label,
                    'warna_verifikasi' => $warnaVerifikasi,
                    'status_kerusakan' => $statusKerusakan,
                    'warna_kerusakan' => $warnaKerusakan
                ]);
            }
            // return dd([$template, $list]);
            return $template;
        } catch (Throwable $e) {
            error_log("Gagal membangun item template input " . $e);
            report("Gagal membangun item template input " . $e);
            return 'Pengambilan Gagal';
        }
    }

    /**
     * Bangun data yang akan digunakan pada modal untuk user menginput data apd mereka.
     * @param array $opsi_apd pilihan apd yang tersedia, didapat dari template dalam bentuk array opsi_apd
     * @return array data yang akan digunakan pada input list option pada modal input apd
     */
    public function bangunItemModalInputApd(array $opsi_apd): array
    {
        try {

            // array kosong untuk di return
            $array = [];

            // pengulangan untuk membangun data untuk pilihan inputan user berdasarkan opsi apd yang diberikan
            foreach ($opsi_apd as $apd) {
                // ambil id apd yang akan dijadikan template dan diambil data yang telah diatur oleh admin
                $id_apd = $apd;

                // ambil data tersebut
                $model = ApdList::where('id_apd', '=', $id_apd)->first();

                $nama_apd = $model->nama_apd;
                $merk_apd = $model->merk_apd;
                $size_apd = $model->size->opsi;
                $kondisi_apd = $model->kondisi->opsi;
                $gambar_apd = $model->image;



                // gambar apd harus berupa array untuk mempermudah pengecekan
                // saat admin tidak memberikan stock gambar apd
                if (is_null($gambar_apd)) {
                    $gambar_apd = [];
                }
                // saat admin memberikan banyak stock gambar apd 
                else if (str_contains($gambar_apd, '||')) {
                    $gambar_apd = explode('||', $gambar_apd);
                }
                // saat admin memberikan satu stock gambar apd
                else {
                    $gambar = $gambar_apd;
                    $gambar_apd = [$gambar];
                }

                // masukan ke array kosong
                array_push($array, [
                    'id_apd' => $id_apd,
                    'nama_apd' => $nama_apd,
                    'merk_apd' => $merk_apd,
                    'size_apd' => $size_apd,
                    'kondisi_apd' => $kondisi_apd,
                    'gambar_apd' => $gambar_apd
                ]);
            }

            // dd($array);
            return $array;
        } catch (Throwable $e) {
            error_log("Gagal membangun item modal input berdasarkan opsi apd " . $e);
            report("Gagal membangun item modal input berdasarkan opsi apd " . $e);
            return [];
        }
    }

    public function bangunItemModalInputApdById(string $id_apd): array
    {
        $array = [];


        $model = ApdList::where('id_apd', '=', $id_apd)->first();

        $nama_apd = $model->nama_apd;
        $merk_apd = $model->merk_apd;
        $size_apd = $model->size->opsi;
        $kondisi_apd = $model->kondisi->opsi;
        $gambar_apd = $model->image;

        error_log('id apd : ' . $id_apd . ' nama apd : ' . $nama_apd);


        // gambar apd harus berupa array untuk mempermudah pengecekan
        if (is_null($gambar_apd)) {
            $gambar_apd = [];
        } else if (str_contains($gambar_apd, '||')) {
            $gambar_apd = explode('||', $gambar_apd);
        } else {
            $gambar = $gambar_apd;
            $gambar_apd = [$gambar];
        }

        array_push($array, [
            'id_apd' => $id_apd,
            'nama_apd' => $nama_apd,
            'merk_apd' => $merk_apd,
            'size_apd' => $size_apd,
            'kondisi_apd' => $kondisi_apd,
            'gambar_apd' => $gambar_apd
        ]);

        // dd($array);
        return $array;
    }

    public function siapkanGambarTemplateBesertaPathnya(string $stringGambar,$id_jenis, $id_apd)
    {
        try {
            // jika gambar banyak
            if (str_contains($stringGambar, "||")) {
                // jadikan string gambar tersebut ke bentuk array
                $gbr = explode("||", $stringGambar);
            } else
                $gbr = $stringGambar;

            $fc = new FileController;

            if (is_array($gbr)) {
                $gambar = [];
                foreach ($gbr as $g) {
                    array_push($gambar, 'storage/' . $fc->buatPathFileApdItem($id_jenis, $id_apd) . '/' . $g);
                }
                return $gambar;
            } else {
                if ($gbr == "")
                    return "";
                else
                    return 'storage/' . $fc->buatPathFileApdItem($id_jenis, $id_apd) . '/' . $gbr;
            }
        } catch (Throwable $e) {
            error_log('Gagal menyiapkan gambar inputan user ' . $e);
            return "";
        }
    }

    public function siapkanGambarInputanBesertaPathnya($stringGambar, $nrk, $id_jenis, $id_periode): array|string
    {
        try {
            if(!is_null($stringGambar))
            {
                // jika gambar banyak
                if (str_contains($stringGambar, "||")) {
                    // jadikan string gambar tersebut ke bentuk array
                    $gbr = explode("||", $stringGambar);
                } else
                    $gbr = $stringGambar;

                $fc = new FileController;

                if (is_array($gbr)) {
                    $gambar = [];
                    foreach ($gbr as $g) {
                        array_push($gambar, 'storage/' . $fc->buatPathFileApdUpload($nrk, $id_jenis, $id_periode) . '/' . $g);
                    }
                    return $gambar;
                } else {
                    if ($gbr == "")
                        return "";
                    else
                        return 'storage/' . $fc->buatPathFileApdUpload($nrk, $id_jenis, $id_periode) . '/' . $gbr;
                }
            }
            else
            {
                return "";
            }
            
        } catch (Throwable $e) {
            error_log('Gagal menyiapkan gambar inputan user ' . $e);
            return "";
        }
    }

    /**
     * @todo Fungsi untuk ambil id periode
     * @body Buat fungsi untuk ambil id periode di db untuk data periode saat insert data input apd
     */
    public function ambilIdPeriodeInput($tanggal)
    {
        // where tanggal awal < $tanggal < tanggal akhir -> value('id')
    }

    /**
     * Helper untuk membantu mengambil gambar pertama dari value string gambar yang disimpan di db
     * @param string $stringGambar value kolom image atau gambar langsung dari db
     * @return string Nama gambar yang akan digunakan
     */
    public function ambilGambarPertama($stringGambar)
    {
        try {

            // jika gambar banyak
            if (str_contains($stringGambar, "||")) {
                // jadikan string gambar tersebut ke bentuk array
                $gbr = explode("||", $stringGambar);

                // return string gambar yang telah menjadi array
                return $gbr[0];
            }

            // jika gambar hanya satu atau tidak ada, return as is
            return $stringGambar;
        } catch (Throwable $e) {

            // jika exception, berikan gambar stock untuk tidak ada gambar
            return "apd_no-image.png";
        }
    }

    /**
     * @param array $opsiApd
     */
    public function ambilGambarPertamaUntukThumbnail($id_jenis, $opsiApd)
    {
        try {

            // panggil FileController untuk membantu merubah path dan/atau merubah nama gambar
            $fc = new FileController;

            // jadikan gambar apd pertama dari opsi yang disediakan sebagai gambar thumbnail
            $targetApd = $opsiApd[0];

            // ambil gambar apd tersebut
            $gambarApd = ApdList::where('id_apd', '=', $targetApd)->first()->image;

            // ambil gambar pertama dari apd tersebut
            $gbr = $this->ambilGambarPertama($gambarApd);

            // ubah path agar dapat ditampilkan di .blade.php
            /**
             * @todo ganti agar tidak menggunakan path placeholder
             */
            $path = $fc::$apdPlaceholderBasePath; //<-- sementara untuk tes, gambar di tempatkan di placeholder
            // $path = $fc->buatPathFileApdItem($id_jenis,$targetApd);

            // jika memang tidak ada gambar yang disediakan, gantikan dengan no image
            if (strlen($gbr) < 1)
                $gbr = "apd_no-image.png";

            // return path agar dapat dengan mudah ditampilkan di .blade.php
            return 'storage/' . $path . '/' . $gbr;
        } catch (Throwable $e) {

            // jika exception, berikan no image
            return $fc::$apdPlaceholder;
        }
    }

    public function ambilStatusVerifikasi($id_jenis, $id_pegawai = "", $periode = 1)
    {
        try {

            if ($id_pegawai == "")
                $id_pegawai = Auth::user()->userid;

            return verif::tryFrom(InputApd::where('id_pegawai', '=', $id_pegawai)->where('id_jenis', '=', $id_jenis)->where('id_periode', '=', $periode)->first()->verifikasi_status);
        } catch (Throwable $e) {
            // error_log("Gagal mengambil status verifikasi untuk id jenis  '" . $id_jenis . "' " . $e);
            // report("Gagal mengambil status verifikasi untuk id jenis  '" . $id_jenis . "' " . $e);
            return verif::input();
        }
    }

    public function ambilStatusKerusakan($id_jenis, $id_pegawai = "", $periode = 1)
    {
        try {

            if ($id_pegawai == "")
                $id_pegawai = Auth::user()->userid;

            return status::tryFrom(InputApd::where('id_pegawai', '=', $id_pegawai)->where('id_jenis', '=', $id_jenis)->where('id_periode', '=', $periode)->first()->kondisi);
        } catch (Throwable $e) {
            // error_log("Gagal mengambil status kerusakan untuk id jenis  '" . $id_jenis . "' " . $e);
            // report("Gagal mengambil status kerusakan untuk id jenis  '" . $id_jenis . "' " . $e);
            return 'Proses';
        }
    }
    

    /**
     * Ambil status verifikasi dan lempar nilai beserta label mereka ke value lain
     * @param int|verif $status integer atau enum yang digunakan untuk mengambil status
     * @param string $label label yang akan dilempar ke value baru
     * @param int $value nilai yang akan dilempar ke value baru
     */
    public function ekstrakStatusVerifikasi(int|verif $status, string &$label, int|string &$value)
    {
        try {

            $tes = verif::tryFrom($status);

            $label = $tes->label;
            $value = $tes->value;
        } catch (Throwable $e) {
            error_log('gagal ambil status verifikasi ' . $e);
            $value = 1;
            $label = verif::tryFrom($status)->label;
        }
    }
}
