<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Eapd\ApdList;
use App\Models\Eapd\InputApdTemplate;
use App\Models\Eapd\Jabatan;
use App\Enum\VerifikasiApd as verif;
use App\Models\Eapd\ApdJenis;
use App\Models\Eapd\InputApd;
use App\Models\Eapd\Pegawai;
use Error;
use Throwable;

class ApdDataController extends Controller
{

    public static $jumlahBatasUploadGambar = 3;

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

    public function muatSatuContohDaftarInputApd(): array
    {
        return ['id_jenis' => 'H001', 'opsi_apd' => ['H-bro-0000', 'H-fir-0000', 'H-bro-0001']];
    }

    public function muatListInputApdDariTemplate($id_periode = 1, $id_jabatan = "")
    {
        try {

            // jika parameter jabatan tidak diisi, maka ambil jabatan user
            if ($id_jabatan == "") {
                $id_jabatan = Auth::user()->data->id_jabatan;
            }

            // ambil template penginputan apd dari database menggunakan pivot table yang telah di buat di model
            $list = Jabatan::where('id_jabatan', '=', $id_jabatan)->first()->templatePadaPeriode($id_periode)->first()->template;

            // return dd($list);
            return $list;
        } catch (Throwable $e) {
            error_log('gagal memuat list ' . $e);
        }
    }

    public function muatStatusVerifikasiDariInputanPegawai($id_periode = 1, $nrk = "", $target_verifikasi = 0): array
    {
        try {

            // jika parameter nrk kosong, ambil nrk dan jabatan user
            if ($nrk == "") {
                $nrk = Auth::user()->nrk;
                $id_jabatan = Auth::user()->data->id_jabatan;
            }
            // jika paramter nrk diisi, cukup ambil jabatan user
            else {
                $id_jabatan = Pegawai::where('nrk', '=', $nrk)->first()->id_jabatan;
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
                if ($input = InputApd::where('nrk', '=', $nrk)->where('id_jenis', '=', $id_jenis)->where('id_periode', '=', $id_periode)->first())
                    // user telah menginput

                    // apakah ada status verifikasi yang dicari?
                    if ($target_verifikasi != 0) {
                        // ada status verifikasi tertentu yang dicari

                        // apakah inputan user memiliki verifikasi yang sesuai
                        if (verif::tryFrom($input->verifikasi_status)->value == $target_verifikasi)
                            // inputan user memiliki verifikasi yang dicari

                            // masukan ke $list
                            array_push($list, [
                                'id_jenis' => $id_jenis,
                                'status' => verif::tryFrom($input->verifikasi_status)->label
                            ]);
                    } else {
                        // tidak ada status verifikasi tertentu yang dicari

                        // masukan ke $list
                        array_push($list, [
                            'id_jenis' => $id_jenis,
                            'status' => verif::tryFrom($input->verifikasi_status)->label
                        ]);
                    }
            }

            // berikan daftar yang telah diisi dari pengulangan
            return $list;
        } catch (Throwable $e) {
            error_log('Gagal memuat status verifikasi dari list input apd ' . $e);
            return [];
        }
    }

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


    /**
     * @todo Fungsi untuk ambil id periode
     * @body Buat fungsi untuk ambil id periode di db untuk data periode saat insert data input apd
     */
    public function ambilIdPeriodeInput($tanggal)
    {
        // where tanggal awal < $tanggal < tanggal akhir -> value('id')
    }

    /**
     * @param string $stringGambar
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

    public function ambilStatusVerifikasi($id_jenis, $nrk = "", $periode = 1)
    {
        try {

            if ($nrk == "")
                $nrk = Auth::user()->nrk;

            return verif::tryFrom(InputApd::where('nrk', '=', $nrk)->where('id_jenis', '=', $id_jenis)->where('id_periode', '=', $periode)->first()->verifikasi_status);
        } catch (Throwable $e) {
            // error_log("Gagal mengambil status verifikasi untuk id jenis  '" . $id_jenis . "' " . $e);
            // report("Gagal mengambil status verifikasi untuk id jenis  '" . $id_jenis . "' " . $e);
            return verif::input();
        }
    }

    public function ambilStatusKerusakan($id_jenis, $nrk = "", $periode = 1)
    {
        try {

            if ($nrk == "")
                $nrk = Auth::user()->nrk;

            return InputApd::where('nrk', '=', $nrk)->where('id_jenis', '=', $id_jenis)->where('id_periode', '=', $periode)->first()->kondisi;
        } catch (Throwable $e) {
            // error_log("Gagal mengambil status kerusakan untuk id jenis  '" . $id_jenis . "' " . $e);
            // report("Gagal mengambil status kerusakan untuk id jenis  '" . $id_jenis . "' " . $e);
            return 'Proses';
        }
    }
}
