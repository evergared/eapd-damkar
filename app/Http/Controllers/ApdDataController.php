<?php

namespace App\Http\Controllers;

use App\Enum\KeberadaanApd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ApdList;
use App\Models\InputApdTemplate;
use App\Models\Jabatan;
use App\Enum\VerifikasiApd as verif;
use App\Enum\StatusApd as status;
use App\Models\ApdJenis;
use App\Models\InputApd;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\PeriodeInputApd;
use App\Models\Provinsi;
use App\Models\Wilayah;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\Log;
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

    #region Untuk testing
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
    #endregion


    public function muatOpsiApd(string $id_jenis, $id_periode = null, $id_jabatan = "")
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
     * Ambil template untuk input apd dari database berdasarkan id_periode dan jabatan
     * @param int $id_periode id_periode untuk template yang dicari, dalam bentuk id id_periode
     * @param string $id_jabatan jabatan untuk template yang dicari, dalam bentuk id jabatan
     */
    public function muatListInputApdDariTemplate($id_periode = null, $id_jabatan = "")
    {
        try {

            // jika parameter jabatan tidak diisi, maka ambil jabatan user
            if ($id_jabatan == "") {
                $id_jabatan = Auth::user()->data->id_jabatan;
            }

            // jika parameter periode tidak diisi, maka ambil periode paling atas
            if($id_periode == null)
            {
                $periode = PeriodeInputApd::where('aktif',true)->get()->first();
                if(is_null($periode))
                    return [];
                $id_periode = $periode->id_periode;

            }

            $template_pada_periode = InputApdTemplate::where("id_periode",$id_periode)->where("id_jabatan", $id_jabatan)->get()->first()->template;
            // dd($template_pada_periode);
            
            if(!is_null($template_pada_periode))
                return $template_pada_periode;
            
            error_log('template input apd tidak ditemukan untuk jabatan '.$id_jabatan);
            return [];

        } catch (Throwable $e) {
            error_log("periode ". $id_periode);
            error_log("jabatan ". $id_jabatan);
            error_log('gagal memuat list template input '.$e);
            return [];
        }
    }


    /**
     * Muat apa saja yang telah diinput oleh pegawai pada id_periode yang dicari
     * @param int $id_periode id_periode yang dicari, dalam bentuk id id_periode
     * @param string $id_pegawai pegawai yang dicari, dalam bentuk id pegawai
     * @param int $target_verifikasi jika ada status verifikasi yang dicari, masukan value dari enum /App/Enum/VerifikasiApd.php atau integer 1~5
     * @return array list apa saja yang telah diinput oleh pegawai, di dapat dari tabel input_apd
     */
    public function muatInputanPegawai($id_periode = null, $id_pegawai = "", $target_verifikasi = 0): array
    {
        try {

            // jika parameter id_pegawai kosong, ambil nrk dan jabatan user
            if ($id_pegawai == "") {
                $id_pegawai = Auth::user()->id_pegawai;
                $id_jabatan = Auth::user()->data->id_jabatan;
            }
            // jika paramter id_pegawai diisi, cukup ambil jabatan user
            else {
                $id_jabatan = Pegawai::where('id_pegawai', '=', $id_pegawai)->first()->id_jabatan;
            }

            if($id_periode == null)
            $id_periode = PeriodeInputApd::where('aktif',true)->get()->first()->id_periode;

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

                            $this->ekstrakStatusVerifikasi(verif::tryFrom($input->verifikasi_status)->value, $verifikasi_label, $verifikasi_status);

                            // masukan ke $list
                            array_push($list, [
                                'id_jenis' => $id_jenis,
                                'nama_jenis' => ApdJenis::where('id_jenis', '=', $id_jenis)->first()->nama_jenis,
                                'id_apd' => $input->id_apd,
                                'gambar_apd' => $this->siapkanGambarInputanBesertaPathnya($input->image, $id_pegawai, $id_jenis, $id_periode),
                                'status_keberadaan' => KeberadaanApd::tryFrom($input->keberadaan)->label,
                                'warna_keberadaan'=> $sdc->ubahKeberadaanApdKeWarnaBootstrap($input->keberadaan),
                                'enum_verifikasi' => $input->verifikasi_status,
                                'status_verifikasi' => $verifikasi_label,
                                'warna_verifikasi' => $sdc->ubahVerifikasiApdKeWarnaBootstrap($verifikasi_status),
                                'status_kerusakan' => $this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode),
                                'warna_kerusakan' => $sdc->ubahKondisiApdKeWarnaBootstrap($this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)),
                                'komentar_pengupload' => $input->komentar_pengupload,
                                'id_verifikator' => $input->verifikasi_oleh,
                                'komentar_verifikator' => $input->komentar_verifikator


                            ]);
                        }
                    } else {
                        // tidak ada status verifikasi tertentu yang dicari

                        $verifikasi_status = "";
                        $verifikasi_label = "";

                        $this->ekstrakStatusVerifikasi(verif::tryFrom($input->verifikasi_status)->value, $verifikasi_label, $verifikasi_status);

                        // masukan ke $list
                        array_push($list, [
                            'id_jenis' => $id_jenis,
                            'nama_jenis' => ApdJenis::where('id_jenis', '=', $id_jenis)->first()->nama_jenis,
                            'id_apd' => $input->id_apd,
                            'gambar_apd' => $this->siapkanGambarInputanBesertaPathnya($input->image, $id_pegawai, $id_jenis, $id_periode),
                            'status_keberadaan' => KeberadaanApd::tryFrom($input->keberadaan)->label,
                            'warna_keberadaan'=> $sdc->ubahKeberadaanApdKeWarnaBootstrap($input->keberadaan),
                            'enum_verifikasi' => $input->verifikasi_status,
                            'status_verifikasi' => $verifikasi_label,
                            'warna_verifikasi' => $sdc->ubahVerifikasiApdKeWarnaBootstrap($verifikasi_status),
                            'status_kerusakan' => $this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)->label,
                            'warna_kerusakan' => $sdc->ubahKondisiApdKeWarnaBootstrap($this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)),
                            'komentar_pengupload' => $input->komentar_pengupload,
                            'id_verifikator' => $input->verifikasi_oleh,
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

    public function muatSatuInputanPegawai($id_jenis, $id_periode = null, $id_pegawai = ""): array|bool|null
    {
        try{
            // jika parameter id pegawai kosong
            if ($id_pegawai == "") {
                $id_pegawai = Auth::user()->id_pegawai;
            }
            

            if($id_periode == null)
                $id_periode = $this->ambilIdPeriodeInput();


            if ($input = InputApd::where('id_pegawai', '=', $id_pegawai)->where('id_jenis', '=', $id_jenis)->where('id_periode', '=', $id_periode)->first())
            {
                $verifikasi_status = "";
                $verifikasi_label = "";

                $this->ekstrakStatusVerifikasi(verif::tryFrom($input->verifikasi_status)->value, $verifikasi_label, $verifikasi_status);
                
                // panggil untuk mambantu mengubah warna status
                $sdc = new StatusDisplayController;
                $verifikator = Pegawai::find($input->verifikasi_oleh);

                return [
                            'id_jenis' => $id_jenis,
                            'nama_jenis' => ApdJenis::where('id_jenis', '=', $id_jenis)->first()->nama_jenis,
                            'id_apd' => $input->id_apd,
                            'size_apd' => ($input->size)?$input->size:"-",
                            'data_terakhir_update' => $input->data_diupdate,
                            'verifikasi_terakhir_update' => Carbon::createFromTimestamp($input->updated_at)->toDateTimeString(),
                            'gambar_apd' => $this->siapkanGambarInputanBesertaPathnya($input->image, $id_pegawai, $id_jenis, $id_periode),
                            'status_keberadaan' => $input->keberadaan,
                            'warna_keberadaan' => $sdc->ubahKeberadaanApdKeWarnaBootstrap($input->keberadaan),
                            'enum_verifikasi'=>$input->verifikasi_status,
                            'status_verifikasi' => $verifikasi_label,
                            'warna_verifikasi' => $sdc->ubahVerifikasiApdKeWarnaBootstrap($verifikasi_status),
                            'status_kerusakan' => $this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)->label,
                            'warna_kerusakan' => $sdc->ubahKondisiApdKeWarnaBootstrap($this->ambilStatusKerusakan($id_jenis, $id_pegawai, $id_periode)),
                            'komentar_pengupload' => $input->komentar_pengupload,
                            'id_verifikator' => $input->verifikasi_oleh,
                            'nama_verifikator'=> (is_null($verifikator))? "" : $verifikator->nama,
                            'jabatan_verifikator'=> (is_null($verifikator))? "" : Jabatan::find($verifikator->id_jabatan)->nama_jabatan,
                            'komentar_verifikator' => $input->komentar_verifikator
                        ];
            }

            return null;

        }
        catch(Throwable $e)
        {
            error_log('Apd Data Controller Error : Kesalahan saat memuat satu inputan pegawai '.$e);
            return false;
        }
    }

    #region Method hitung capaian inputan

    public function hitungCapaianInputPegawai($id_pegawai, int|array &$maks, int|array &$capaian, $id_periode = null, $target_verifikasi = 0)
    {
        $pegawai = Pegawai::find($id_pegawai);
        $yang_harus_diinput = 0;
        $yang_telah_diinput = 0;

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

                        }
                    }
                    else
                        $yang_telah_diinput++;

                }

            }

        }

        $maks = $yang_harus_diinput;
        $capaian = $yang_telah_diinput;
    }

    public function hitungCapaianInputPos($pos, int|array &$maks, int|array &$capaian, $id_periode, $target_verifikasi = 0)
    {
        try{
            
            $array_pegawai = Pegawai::where("id_penempatan",$pos)->get();

            $yang_harus_diinput = 0;
            $yang_telah_diinput = 0;

            foreach($array_pegawai as $pegawai)
            {
                $max = 0;
                $input = 0;
                $this->hitungCapaianInputanPegawai($pegawai['id_pegawai'], $max, $input, $id_periode, $target_verifikasi);
                
                $yang_harus_diinput = $yang_harus_diinput + $max;
                $yang_telah_diinput = $yang_telah_diinput + $input;
            }

            $maks = $yang_harus_diinput;
            $capaian = $yang_telah_diinput;
        }
        catch(Throwable $e)
        {
            error_log("Gagal dalam menghitung capaian input pos ".$e);
            $maks = 0;
            $capaian = 0;

        }
    }

    public function hitungCapaianInputSektor($sektor, int|array &$maks, int|array &$capaian,$id_periode = null, $target_verifikasi = 0)
    {
        try{

            if($id_periode == null)
                $id_periode = PeriodeInputApd::where('aktif',true)->get()->first()->id_periode;

            // ambil daftar seluruh pegawai di sektor (termasuk staff dan kasie sektor)
            $array_pegawai = Pegawai::where('id_penempatan','like',$sektor.'%')->get();

            // siapkan array untuk proses penghitungan
            $yang_harus_diinput = 0;
            $yang_telah_diinput = 0;

            // menghitung apa yg harus diinput dan apa yang telah diinput oleh tiap pegawai
            foreach($array_pegawai as $pegawai)
            {
                $max = 0;
                $input = 0;
                $this->hitungCapaianInputPegawai($pegawai['id_pegawai'], $max, $input, $id_periode, $target_verifikasi);
                
                $yang_harus_diinput = $yang_harus_diinput + $max;
                $yang_telah_diinput = $yang_telah_diinput + $input;
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

    public function hitungCapaianInputSudin($sudin, int|array &$maks, int|array &$capaian,$id_periode = null, $target_verifikasi = 0)
    {
        try{

            // ambil list semua sektor di suatu wilayah
            $list_sektor = Penempatan::where('id_parent_penempatan','=',$sudin)->where('keterangan','=','sektor')->get();
            
            $yang_harus_diinput = 0;
            $yang_telah_diinput = 0;

            // pengulangan untuk mengambil jumlah data inputan
            foreach($list_sektor as $sektor)
            {
                $yang_harus_diinput_sektor = 0;
                $yang_telah_diinput_sektor = 0;
                $this->hitungCapaianInputSektor($sektor,$yang_harus_diinput_sektor,$yang_telah_diinput_sektor,$id_periode,$target_verifikasi);

                $yang_harus_diinput = $yang_harus_diinput + $yang_harus_diinput_sektor;
                $yang_telah_diinput = $yang_telah_diinput + $yang_telah_diinput_sektor;
            }

            $maks = $yang_harus_diinput;
            $capaian = $yang_telah_diinput;
        }
        catch(Throwable $e)
        {
            error_log('Apd Data Controller Error : kesalahan saat menghitung capaian input tingkat sudin untuk sudin  '.$sudin.' at hitungCapaianInputSudin() '.$e);
            Log::info('Apd Data Controller Error : kesalahan saat menghitung capaian input tingkat sudin untuk sudin  '.$sudin.' at hitungCapaianInputSudin() '.$e);
            $maks = 0;
            $capaian = 0;
        }
    }

    public function hitungCapaianInputSubbag($subbag, int|array &$maks, int|array &$capaian, $id_periode = null, $target_verifikasi = 0)
    {

        try{
            $list_pegawai = Pegawai::where('id_penempatan',$subbag)->get();

            $yg_harus_diinput = 0;
            $yg_telah_diinput = 0;

            foreach($list_pegawai as $pegawai)
            {
                $max = 0;
                $input = 0;
                $this->hitungCapaianInputPegawai($pegawai['id_pegawai'], $max, $input, $id_periode, $target_verifikasi);
                
                $yg_harus_diinput = $yg_harus_diinput + $max;
                $yg_telah_diinput = $yg_telah_diinput + $input;
            }
        }
        catch(Throwable $e)
        {
            error_log('Apd Data Controller Error : kesalahan saat menghitung capaian input subbag dg id penempatan  '.$subbag.' at hitungCapaianInputSubbag() '.$e);
            Log::info('Apd Data Controller Error : kesalahan saat menghitung capaian input subbag dg id penempatan  '.$subbag.' at hitungCapaianInputSubbag() '.$e);
            $maks = 0;
            $capaian = 0;
        }
    }

    public function hitungCapaianInputDinas($id_periode)
    {
        $data_capaian = [];

        // $data_capaian = [
        //     provinsi => [
        //         max,
        //         value,
        //         sudin => [
        //             max,
        //             value,
        //             sektor => [
        //                 max,
        //                 value,
        //                 pos => [
        //                     max,
        //                     value,
        //                 ]
        //             ]
        //         ]
        //     ]
        // ]
        try{

            $capaian_dinas = [];

            $list_sudin = Penempatan::where('tipe','sudin')->get();
            $list_subbag_dinas = Penempatan::where('id_parent_penempatan', 'D_1')->where('tipe', 'subbag')->get();

            foreach($list_subbag_dinas as $subbag)
            {
                $maks = 0;
                $terinput = 0;
                $tervalidasi = 0;

                $this->hitungCapaianInputSubbag($subbag['id_penempatan'], $maks, $terinput, $id_periode);
                $this->hitungCapaianInputSubbag($subbag['id_penempatan'], $maks, $tervalidasi, $id_periode, 3);

                $capaian_dinas[$subbag['nama_penempatan']] = [
                    'value_max' => $maks,
                    'value_inputan' => $terinput,
                    'value_validasi' => $tervalidasi
                ];
            }

            foreach($list_sudin as $sudin)
            {
                $capaian_sudin = [];

                // hitung subbag sudin tsb
                $list_subbag_sudin = Penempatan::where('id_parent_penempatan', $sudin['id_penempatan'])->where('tipe','subbag')->get();
                foreach($list_subbag_sudin as $subbag)
                {
                    
                    $maks = 0;
                    $terinput = 0;
                    $tervalidasi =0;
                    $this->hitungCapaianInputSubbag($subbag->id_penempatan, $maks, $terinput, $id_periode);
                    $this->hitungCapaianInputSubbag($subbag->id_penempatan, $maks, $tervalidasi, $id_periode, 3);

                    $capaian_sudin[$subbag['nama_penempatan']] = [
                        'value_max' => $maks,
                        'value_inputan' => $terinput,
                        'value_validasi' => $tervalidasi
                    ];
                }

                // hitung tiap sektor dan pos dibawahnya
                $list_sektor = Penempatan::where('id_parent_penempatan', $sudin['id_penempatan'])->where('tipe','sektor')->get();
                foreach($list_sektor as $sektor)
                {
                    $capaian_sektor = [];
                    
                    // hitung satgas dan kasek
                    $list_pegawai_sektor_nonpos = Pegawai::where('id_penempatan',$sektor['id_penempatan'])->get();
                    $maks = 0;
                    $terinput = 0;
                    $tervalidasi = 0;
                    foreach($list_pegawai_sektor_nonpos as $pegawai)
                    {
                        $max = 0;
                        $input = 0;
                        $validasi = 0;
                        $this->hitungCapaianInputPegawai($pegawai['id_pegawai'], $max, $input, $id_periode);
                        $this->hitungCapaianInputPegawai($pegawai['id_pegawai'], $max, $validasi, $id_periode, 3);
                        
                        $maks = $maks + $max;
                        $terinput = $terinput + $input;
                        $tervalidasi = $tervalidasi + $validasi;
                    }

                    $capaian_nonpos = [
                        'value_max' => $maks,
                        'value_inputan' => $terinput,
                        'value_validasi' => $tervalidasi
                    ];


                    //hitung pegawai tiap pos
                    $capaian_pos = [];
                    $list_pos = Penempatan::where('id_parent_penempatan', $sektor['id_penempatan'])->where('tipe','pos')->get();
                    foreach($list_pos as $pos)
                    {
                        $max = 0;
                        $input = 0;
                        $validasi = 0;

                        $list_pegawai = Pegawai::where('id_penempatan', $pos['id_penempatan'])->get();

                        foreach($list_pegawai as $pegawai)
                        {
                            $maks = 0;
                            $terinput = 0;
                            $tervalidasi =0;

                            $this->hitungCapaianInputPegawai($pegawai['id_pegawai'], $maks, $terinput, $id_periode);
                            $this->hitungCapaianInputPegawai($pegawai['id_pegawai'], $maks, $tervalidasi, $id_periode, 3);

                            $max = $max + $maks;
                            $input = $input + $terinput;
                            $validasi = $validasi + $tervalidasi;
                        }

                        $capaian_pos[$pos['nama_penempatan']] = [
                            'value_max' => $max,
                            'value_inputan' => $input,
                            'value_validasi' => $validasi
                        ];

                    }

                    $capaian_sektor = $capaian_pos;
                    $capaian_sektor['non-pos'] = $capaian_nonpos;

                    $capaian_sudin[$sektor['nama_penempatan']] = $capaian_sektor;
                }

                $capaian_dinas[$sudin['nama_penempatan']] = $capaian_sudin;
            }

            $data_capaian = $capaian_dinas;

            return $data_capaian;
        }
        catch(Throwable $e)
        {
            error_log("Apd Data Controller error : kesalahan saat menghitung angka capaian input apd tingkat dinas at hitungCapaianInputDinas() ".$e);
            Log::info("Apd Data Controller error : kesalahan saat menghitung angka capaian input apd tingkat dinas at hitungCapaianInputDinas() ".$e);
            return $data_capaian;
        }

    }
#endregion

    /**
     * Bangun list yang akan digunakan untuk thumbnail di halaman apdku.
     * @param int $id_periode id_periode yang dicari, dalam bentuk id id_periode
     * @param string $id_jabatan jabatan yang dicari, dalam bentuk id jabatan
     * @return array|string apa saja yang akan ditampilkan untuk thumbnail
     */
    public function bangunListInputApdDariTemplate($id_periode = null, $id_jabatan = "")
    {
        try {

            // jika parameter jabatan tidak diisi, maka ambil jabatan user
            if ($id_jabatan == "") {
                $id_jabatan = Auth::user()->data->id_jabatan;
            }

            // jika parameter id_periode tidak diisi, maka ambil id id_periode pertama dari database
            if($id_periode == null)
            {
                $periode = PeriodeInputApd::where('aktif',true)->get()->first();
                if(is_null($periode))
                    return [];
                $id_periode = $periode->id_periode;
            }

            error_log("id_periode : ".$id_periode);

            // ambil template input apd dari database berdasarkan pivot table yang telah dibuat di model
            $list = $this->muatListInputApdDariTemplate($id_periode,$id_jabatan);
            // return dd($list);
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
                error_log('id dari opsi yang dicari : '.$id_apd);

                // ambil data tersebut
                $model = ApdList::where('id_apd', '=', $id_apd)->first();

                $nama_apd = $model->nama_apd;
                $merk_apd = $model->merk_apd;
                $size_apd = (is_null($model->size)) ? null : $model->size->opsi;
                $kondisi_apd = (is_null($model->kondisi)) ? null : $model->kondisi->opsi;
                $gambar_apd = $model->image;



                // gambar apd harus berupa array untuk mempermudah pengecekan
                // saat admin tidak memberikan stock gambar apd
                if (is_null($gambar_apd)) {
                    $gambar_apd = null;
                }
                // saat admin memberikan banyak stock gambar apd 
                else if (str_contains($gambar_apd, '||')) {
                    $gambar_apd = explode('||', $gambar_apd);
                }
                // saat admin memberikan satu stock gambar apd
                else {
                    // $gambar = $gambar_apd;
                    // $gambar_apd = [$gambar];
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

    public function muatDataInputanSudin($id_periode = "", $id_wilayah = "")
    {

        if($id_periode == "")
        {
            $id_periode = $this->ambilIdPeriodeInput();
        }

        if($id_wilayah == "")
        {
            // $id_sudin = Penempatan::where('id_wilayah','=',Auth::user()->data->penempatan->id_wilayah)->where('keterangan','=','sudin')->get()->first()->id;
            $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
        }

        try{

            error_log('id wilayah '.$id_wilayah);

             error_log('buat list sektor');
            // buat daftar seluruh sektor yang ada di id_wilayah tsb
            $list_sektor = Penempatan::where('id_wilayah','=',$id_wilayah)->where('keterangan','=','sektor')->pluck('id_penempatan')->toArray();
            error_log('list sektor = '.count($list_sektor));

            // siapkan array untuk menampung data yang akan di return
            $data = array();

            error_log('pengulangan untuk mengambil data di tiap pos');
            // pengulangan untuk menghitung berapa data inputan setiap sektor
            foreach($list_sektor as $sektor)
            {
                error_log('pengulangan untuk sektor '.$sektor);
                // ambil nama sektor sebagai judul tabel
                $nama_sektor = Penempatan::find($sektor)->nama_penempatan;
                $nomor_sektor = "";

                if(str_contains($nama_sektor,'Sektor'))
                {
                    $substring = explode(' ',$nama_sektor);
                    $nomor_sektor = $substring[0].' '.$substring[1];
                }

                // list pos
                $list_pos = Penempatan::where('id_penempatan','like',$sektor.'.%')->where('keterangan','=','pos')->pluck('id_penempatan')->toArray();
                array_push($list_pos,$sektor);
                $data_pos = array();
                error_log('jumlah pos '.count($list_pos));

                #region hitung jumlah karyawan yang perlu melakukan input apd pada tiap pos
                foreach($list_pos as $pos)
                {
                    error_log('pengulangan untuk pos '.$pos);
                    $nama_pos = ($pos == $sektor)? 'Staff / Non-Pos' : Penempatan::find($pos)->nama_penempatan ;
                    $jumlah_asn = 0;
                    $jumlah_pjlp = 0;
                    $yang_harus_diinput = 0;
                    $yang_telah_diinput = 0;
                    $yang_telah_diverif = 0;
                    $seluruh_pegawai = Pegawai::where('id_penempatan','=',$pos)->get();
                    error_log('jumlah pegawai di pos '.$pos.' '.count($seluruh_pegawai));
                    foreach($seluruh_pegawai as $pegawai)
                    {
                        error_log('mulai menghitung untuk pegawai '.$pegawai->nama_pegawai.' dengan jabatan '.$pegawai->id_jabatan);
                        try{
                            $template = $this->muatListInputApdDariTemplate($id_periode,$pegawai->id_jabatan);
                            error_log('template is empty '.is_null($template));
                        }
                        catch(Throwable $e)
                        {
                            $template = null;
                            error_log('template kosong');
                        }

                        if(!is_null($template))
                        {
                            // jika pegawai tsb merupakan pjlp
                            if($pegawai->id_jabatan == 'L001')
                            {
                                error_log('pegawai pjlp');
                                $jumlah_pjlp++;
                            }
                            // jika pegawi tsb bukan pjlp
                            else
                            {
                                error_log('pegawai asn');
                                $jumlah_asn++;
                            }

                            // hitung data inputan
                            foreach($template as $t)
                            {
                                $yang_harus_diinput++;
                            }

                            $inputan_terinput = $this->muatInputanPegawai($id_periode,$pegawai->id);
                            foreach($inputan_terinput as $inputan)
                            {
                                $yang_telah_diinput++;
                            }

                            $inputan_terverif = $this->muatInputanPegawai($id_periode,$pegawai->id,3);
                            foreach($inputan_terverif as $inputan)
                            {
                                $yang_telah_diverif++;
                            }
                        }

                        error_log('jumlah asn : '.$jumlah_asn);
                        error_log('jumlah pjlp : '.$jumlah_pjlp);
                        error_log('yang harus diinput : '.$yang_harus_diinput);
                        error_log('yang telah diinput : '.$yang_telah_diinput);
                        error_log('yang telah diverif : '.$yang_telah_diverif);
                    }

                    error_log('masukan list ke data pos');
                    // masukan data tersebut kedalam array untuk di push ke array data pos
                    array_push($data_pos,array(
                        'id_pos' => $pos,
                        'nama_pos' => $nama_pos,
                        'pegawai_asn' => $jumlah_asn,
                        'pegawai_pjlp' => $jumlah_pjlp,
                        'perlu_diinput' => $yang_harus_diinput,
                        'telah_diinput' => $yang_telah_diinput,
                        'telah_diverif' => $yang_telah_diverif
                    ));

                    

                }
                #endregion

                error_log('rangkum semua data tersebut');
                array_push($data,[
                    'nama_sektor' => $nama_sektor,
                    'nomor_sektor' => $nomor_sektor,
                    'data_pos' => $data_pos
                ]);  
            }

            return $data;
            //  dd($data);
        }
        catch(Throwable $e)
        {
            error_log('Gagal membangun data inputan id_sudin '.$e);
            return [];
        }
    }

    public function muatDataInputanPos($id_penempatan_pos, $id_periode)
    {
        try{

            $data = [];
            $list_pegawai = Pegawai::where('id_penempatan','=',$id_penempatan_pos)->get();

            foreach($list_pegawai as $pegawai)
            {
                $template = $this->muatListInputApdDariTemplate($id_periode,$pegawai->id_jabatan);
                $yang_harus_diinput = 0;
                $yang_telah_diinput = 0;
                $yang_telah_diverif = 0;

                try{
                    $jabatan_pegawai = Jabatan::find($pegawai->id_jabatan)->nama_jabatan;
                }
                catch(Throwable $e)
                {
                    $jabatan_pegawai = '-';
                }

                if(!is_null($template))
                {

                    $yang_harus_diinput = count($template);

                    $yang_telah_diinput = count($this->muatInputanPegawai($id_periode,$pegawai->id));

                    $yang_telah_diverif = count($this->muatInputanPegawai($id_periode,$pegawai->id,3));
                    
                }

                array_push($data,[
                    'id_pegawai' => $pegawai->id,
                    'nama_pegawai' => $pegawai->nama,
                    'jabatan_pegawai' => $jabatan_pegawai,
                    'terinput'=> ($yang_harus_diinput > 0)? round(($yang_telah_diinput/$yang_harus_diinput) * 100, 2) : 0,
                    'terverif'=> ($yang_harus_diinput > 0)? round(($yang_telah_diverif/$yang_harus_diinput) * 100, 2) : 0,
                ]);
            }

            return $data;

        }
        catch(Throwable $e)
        {
            error_log('gagal dalam memuat data inputan pos '.$id_penempatan_pos.' '.$e);
        }
    }

    /**
     * 
     */
    public function muatDataUkuranApd($penempatan = "")
    {
        // jika penempatan kosong, maka ambil penempatan user
        if($penempatan == "")
            $penempatan = Auth::user()->data->id_penempatan;
        
        try{
            // ambil id penempatan berdasarkan tingkat yang setara
            error_log('ambil id penempatan');
            $tingkat_penempatan = Penempatan::find($penempatan)->keterangan;

            $penempatan_ids = null;

            if($tingkat_penempatan == "pos")
            {
                $penempatan_ids = $penempatan;
            }
            elseif($tingkat_penempatan == "sektor")
            {
                $penempatan_ids = Penempatan::where('id_penempatan','like',$penempatan.'%')->get()->pluck('id_penempatan');
            }
            elseif($tingkat_penempatan == "sudin")
            {
                $wil = Penempatan::find($penempatan)->id_wilayah;
                $penempatan_ids = Penempatan::where('id_wilayah',$wil)->get()->pluck('id_penempatan');
            }
            elseif($tingkat_penempatan == "dinas")
            {
                $penempatan_ids = Penempatan::where('id_penempatan','like','#'.filter_var($penempatan,FILTER_SANITIZE_NUMBER_INT).'%')->get()->pluck('id_penempatan');
            }
            error_log('tingkat penempatan : '.$tingkat_penempatan);
            error_log('id penempatan yang dikumpulkan : '.$penempatan_ids);
            /**
             * Data ukuran untuk di return, struktur :
             *  collection $data_ukuran =>[
             *           - collection    $list_apd => [
             *                                          - string        $nama_apd
             *                                          - collection    $ukuran
             *                                          - collection    $pegawai yang menginput
             *                                         ]
             *           - int           $keseluruhan pegawai
             *      ]
             * 
             * Sementara untuk collection ukuran, memiliki struktur
             * collection $ukuran => [size => jumlah], dimana :
             * - size : tipe string, berupa ukuran ("S","M","42","39") yang menjadi key
             * - jumlah : tipe int, berupa berapa banyak ukuran
             */
            $data_ukuran = array('list_apd' => array() ,'keseluruhan_pegawai' => 0);

            if(is_null($penempatan_ids))
                return $data_ukuran;
            
            // muat seluruh pegawai yang di tempatkan sesuai dengan penempatan
            $pegawai = collect();
            if(is_string($penempatan_ids))
            {
                $pegawai = Pegawai::where('id_penempatan','=',$penempatan_ids)->get();
            }
            else
            {
                foreach($penempatan_ids as $id)
                {
                    $pegawai_pada_penempatan = Pegawai::where('id_penempatan','=',$id)->get();

                    if(!$pegawai_pada_penempatan->isEmpty())
                    foreach($pegawai_pada_penempatan as $result)
                        $pegawai->push($result);
                }
            }
            error_log('jumlah pegawai yang di dapat : '.$pegawai->count());

            // cek setiap data ukuran pada model pegawai dari tiap pegawai yang diambil
            foreach($pegawai as $p)
            {
                error_log('cek pegawai');
                // jika mereka belum pernah mengisi
                if(is_null($p->ukuran))
                    continue;
                
                error_log('pegawai pernah mengisi dengan nama '.$p->nama);
                
                // jika pegawai pernah mengisi inputan ukuran, lakukan pengulangan untuk setiap ukuran yang diinput
                foreach($p->ukuran as $key => $ukuran_apd_pegawai)
                {
                    error_log('mulai cek inputan untuk key '.$key);
                    // jika key pada inputan berupa tanggal, lewati
                    if($key == "tanggal")
                        continue;
                    
                    // selain itu, jika jenis apd sudah ada di data inputan maka lakukan
                    if(array_key_exists($key,$data_ukuran['list_apd']))
                    {
                        $data_apd_tersimpan = $data_ukuran['list_apd'][$key];
                        // tambah collection kosong untuk menampung ukuran jika belum ada
                        if(!array_key_exists('ukuran',$data_apd_tersimpan))
                            $data_apd_tersimpan['ukuran'] = array();

                        // jika di data ukuran sudah ada size tersebut maka
                        if(array_key_exists($ukuran_apd_pegawai,$data_apd_tersimpan['ukuran']))
                            {
                                $jumlah = $data_apd_tersimpan['ukuran'][$ukuran_apd_pegawai]['jumlah'];
                                $data_apd_tersimpan['ukuran'][$ukuran_apd_pegawai]['jumlah'] = $jumlah +1;
                                array_push($data_apd_tersimpan['ukuran'][$ukuran_apd_pegawai]['pegawai'],$p->id);
                            }
                        // jika di data ukuran belum ada size tersebut maka buat ukuran tersebut
                        else
                        {
                            $data_apd_tersimpan['ukuran'][$ukuran_apd_pegawai] = array();
                            $data_apd_tersimpan['ukuran'][$ukuran_apd_pegawai]['jumlah'] = 1;
                            // array_push($data_apd_tersimpan['ukuran'][$ukuran_apd_pegawai]['pegawai'],$p->id);
                            $data_apd_tersimpan['ukuran'][$ukuran_apd_pegawai]['pegawai'] = [$p->id];
                        }

                        // cek apakah ada collection pegawai yang mengisi, jika tidak ada maka buat
                        if(!array_key_exists('pegawai_yang_mengisi',$data_apd_tersimpan))
                        {
                            $data_apd_tersimpan['pegawai_yang_mengisi'] = [$p->id];
                        }
                        else
                            array_push($data_apd_tersimpan['pegawai_yang_mengisi'], $p->id ); 
                        // update data
                        $data_ukuran['list_apd'][$key] = $data_apd_tersimpan;
                    }
                    // jika jenis apd belum ada, maka buat list apd baru
                    else
                    {
                        $data_ukuran["list_apd"][$key] = ["ukuran" => [$ukuran_apd_pegawai => ["jumlah" => 1, "pegawai" => array($p->id)]], "pegawai_yang_mengisi" => [$p->id]];
                    }
                }
            }

            // masukan jumlah semua pegawai yang dimuat
            $data_ukuran["keseluruhan_pegawai"] = $pegawai->count();

            return $data_ukuran;

        }
        catch(Throwable $e)
        {
            error_log('kesalahan saat pengumpulan data ukuran '.$e);
        }
    }

    /**
     * Fungsi untuk menyiapkan gambar apd template dan pathnya yang telah di upload oleh admin.
     * @param string $stringGambar string yang didapat dari field image pada tabel ApdList.
     * @param string $id_jenis id dari jenis apd.
     * @param string $id_apd id dari apd yang gambarnya ingin diambil
     * 
     * @return string|array lokasi fisik/path dari file gambar yang disimpan di server.
     */
    public function siapkanGambarTemplateBesertaPathnya($stringGambar,$id_jenis, $id_apd)
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
                        array_push($gambar, 'storage/' . $fc->buatPathFileApdItem($id_jenis, $id_apd) . '/' . $g);
                    }
                    return $gambar;
                } else {
                    if ($gbr == "")
                        return "";
                    else
                        return 'storage/' . $fc->buatPathFileApdItem($id_jenis, $id_apd) . '/' . $gbr;
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
                        array_push($gambar, $fc->buatPathFileApdUpload($nrk, $id_jenis, $id_periode) . '/' . $g);
                    }
                    return $gambar;
                } else {
                    if ($gbr == "")
                        return null;
                    else
                        return $fc->buatPathFileApdUpload($nrk, $id_jenis, $id_periode) . '/' . $gbr;
                }
            }
            else
            {
                return null;
            }
            
        } catch (Throwable $e) {
            error_log('Gagal menyiapkan gambar inputan user ' . $e);
            return false;
        }
    }

    /**
     * @todo Fungsi untuk ambil id id_periode
     * @body Buat fungsi untuk ambil id id_periode di db untuk data id_periode saat insert data input apd
     */
    public function ambilIdPeriodeInput($tanggal = null, $test = false)
    {
        if($tanggal == null)
            {
                if($test)
                {
                    error_log('test true');
                    return PeriodeInputApd::get()->first()->id_periode;  
                }


                $periode =  PeriodeInputApd::where('aktif',true)->first();

                if(is_null($periode))
                    return null;
                
                return $periode->id_periode;
            }
        
        $periode = PeriodeInputApd::where('tgl_awal','<=',$tanggal)->where('tgl_akhir','>=',$tanggal)->get()->first();

        if(is_null($periode))
            return null;
        
        return $periode->id_periode;
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
            return  $path . '/' . $gbr;
        } catch (Throwable $e) {

            // jika exception, berikan no image
            return $fc::$apdPlaceholder;
        }
    }

    public function ambilStatusVerifikasi($id_jenis, $id_pegawai = "", $id_periode = null)
    {
        try {

            if ($id_pegawai == "")
                $id_pegawai = Auth::user()->id_pegawai;

            // jika parameter id_periode tidak diisi, maka ambil id id_periode pertama dari database
            if($id_periode == null)
            {
                $id_periode = PeriodeInputApd::where('aktif',true)->get()->first()->id_periode;
            }

            return verif::tryFrom(InputApd::where('id_pegawai', '=', $id_pegawai)->where('id_jenis', '=', $id_jenis)->where('id_periode', '=', $id_periode)->first()->verifikasi_status);
        } catch (Throwable $e) {
            // error_log("Gagal mengambil status verifikasi untuk id jenis  '" . $id_jenis . "' " . $e);
            // report("Gagal mengambil status verifikasi untuk id jenis  '" . $id_jenis . "' " . $e);
            return verif::input();
        }
    }

    public function ambilStatusKerusakan($id_jenis, $id_pegawai = "", $id_periode = null)
    {
        try {

            if ($id_pegawai == "")
                $id_pegawai = Auth::user()->id_pegawai;

            // jika parameter id_periode tidak diisi, maka ambil id id_periode pertama dari database
            if($id_periode == null)
            {
                $id_periode = PeriodeInputApd::where('aktif',true)->get()->first()->id_periode;
            }

            return status::tryFrom(InputApd::where('id_pegawai', '=', $id_pegawai)->where('id_jenis', '=', $id_jenis)->where('id_periode', '=', $id_periode)->first()->kondisi);
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
