<?php

namespace App\Http\Controllers\api;

use App\Enum\StatusApd;
use App\Enum\VerifikasiApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\ApdList;
use App\Models\InputApd;
use App\Models\InputApdReupload;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\Wilayah;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

// Controller untuk mengatur data inputan apd
class InputDataApdController extends Controller
{
    public $validate_rule = [
        'keberadaan' => 'required',
        'id_apd' => 'required',
        'kondisi' => 'required'
    ];

    public $validate_message = [
        'keberadaan.required' => "Harap pilih keberadaan apd anda terlebih dahulu.",
        'id_apd.required' => "Silahkan pilih model apd yang dimiliki.",
        'kondisi.required' => "Harap pilih kondisi APD anda.",
    ];
#region CRUD Pegawai
    /**
     * Menampilkan apd apa saja yang perlu diinput oleh pegawai
     *
     * @return \Illuminate\Http\Response
     */
    public function indexHarusInput(Request $r)
    {
        try{
            $periode = $r->input('id_periode');
            $jabatan = $r->input('id_jabatan');

            $adt = new ApdDataController;
            $template = $adt->bangunListInputApdDariTemplate($periode,$jabatan);

            return response()->json([
                "status" => true,
                "message" => "berhasil memuat template untuk inputan",
                "data"=>$template
            ]);
        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menampilkan data.",
                // "error" => $e
            ],500);
        }
    }

    /**
     * Menampilkan data apd untuk pegawai menginput. 
     * Method ini juga mengambil data inputan yang sudah masuk baik sudah atau belum di verif admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function showApdUntukInput(Request $r)
    {
        try{
            $id_periode = $r->input("id_periode");
            $id_jenis = $r->input("id_jenis");
            $index_duplikat = $r->input('index_duplikat'); // untuk mencari jenis apd spesifik di template jika jenis apd lebih dari satu
            $pegawai = Pegawai::where('id_pegawai',$r->user('sanctum')->id_pegawai)->first();

            $adc = new ApdDataController;

            // ambil data inputan sebelumnya
            $inputan_sebelumnya = $adc->muatSatuInputanPegawai($id_jenis, $id_periode, $pegawai->id_pegawai, $index_duplikat);
            
            // Siapkan data yang akan ditampilkan untuk menjadi opsi pada menu input
            /** 
             * Berupa :
             *   status keberadaan
             *   model apd
             *   ukuran
             *   kondisi
             *   no seri
             *   gambar template
             *   gambar terupload
             *   keterangan
            */

            $opsi_dropdown_keberadaan = [
                ['value' => 'Ada', 'text' => 'Sudah Terima dan Ada'],
                ['value' => 'Hilang', 'text' => 'Sudah Terima Tapi Hilang'],
                ['value' => 'Belum Terima', 'text' => 'APD Belum Diterima'],
            ];

            $opsi_apd = $adc->muatOpsiApd($id_jenis,$index_duplikat,$id_periode,$pegawai->id_jabatan);

            $list_apd = [];

            foreach($opsi_apd as $o)
            {
                $apd = ApdList::find($o);

                $list_apd[$o] = [
                    'id_apd' => $o,
                    'nama_apd' => $apd->nama_apd,
                    'opsi_ukuran' => $apd->size->opsi,
                    'opsi_kondisi' => $apd->kondisi->opsi,
                    'gambar_template' => $adc->siapkanGambarTemplateBesertaPathnya($apd->image,$apd->id_jenis, $o),
                    'input_no_seri' => $apd->input_no_seri, // boolean, apakah pegawai perlu input nomer seri
                    'strict_no_seri' => $apd->strict_no_seri, // boolean, apakah no seri yang diinput harus sesuai dg list no seri apd
                ];
            }

            $data = [
                "inputan_sebelumnya" => $inputan_sebelumnya,
                "opsi_keberadaan" => $opsi_dropdown_keberadaan,
                "list_apd" => $list_apd
            ];

            return response()->json([
                "status" => true,
                "message" => "Menampilkan data apd yang pernah diinput",
                "data"=>$data
            ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menampilkan data.",
                // "error" => $e
            ],500);
        }
    }

    /**
     * Menampilkan inputan apd spesifik yang telah diinput oleh pegawai.
     *
     * @return \Illuminate\Http\Response
     */
    public function showApdTerinput(Request $r)
    {
        try{
            $id = $r->input('id_inputan');
            $inputan = InputApd::where('id_inputan',$id)->first();

            return response()->json([
                "status" => true,
                "message" => "Menampilkan data apd yang pernah diinput",
                "data"=>$inputan
            ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menampilkan data.",
                // "error" => $e
            ],500);
        }
    }

    /**
     * Menampilkan apd apa saja yang telah diinput oleh pegawai.
     *
     * @param  string  $id id pegawai
     * @return \Illuminate\Http\Response
     */
    public function showApdPegawai(Request $r)
    {
        try{
            $id = $r->input('id_pegawai');
            $inputan = InputApd::where('id_pegawai',$id)->get()->all();

            return response()->json([
                "status" => true,
                "message" => "Menampilkan keseluruhan data inputan apd seorang pegawai",
                "data"=>$inputan
            ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menampilkan data.",
                "error" => $e
            ],500);
        }
    }

    /**
     * Untuk menyimpan input data apd
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function simpanApdInput(Request $r)
    {
        /**
         * Parameter inputan baru :
         * - Keberadaan 
         * - id periode
         * - id jenis
         * - id apd
         * - id pegawai
         * - size
         * - kondisi
         * - no seri (jika ada)
         * - image
         * - komentar
         * - keterangan jenis apd template (di dapat dari nama jenis apd saat menginput, fungsi : untuk identifier tambahan jika ada 2 atau lebih apd dengan jenis yang sama pada template)
         * 
         * Yang perlu diperhatikan :
         * - apakah apd perlu input ukuran
         * - apakah apd perlu input no seri
         * - jika perlu input no seri, apakah no seri bersifat strict
         */

        try{

            // parameter inputan
            $keberadaan = $r->input('keberadaan');
            $id_periode = $r->input('id_periode');
            $id_jenis = $r->input('id_jenis');
            $id_apd = $r->input('id_apd');
            $id_pegawai = $r->input('id_pegawai');
            $size = $r->input('size');
            $kondisi = $r->input('id_periode');
            $no_seri = $r->input('no_seri');
            $komentar = $r->input('komentar');
            $keterangan = $r->input('keterangan'); // identifier tambahan pada record db
            $index_duplikat = $r->input('index_duplikat');

            // untuk mengubah validasi
            $perlu_input_size = $r->input('perlu_input_size');
            $input_no_seri = $r->input('input_no_seri');
            $strict_no_seri = $r->input('no_seri_strict');
            $this->ubahParameterValidasi($perlu_input_size,$input_no_seri,$strict_no_seri);

            // proses validasi inputan
            $validasi = Validator::make($r,$this->validate_rule,$this->validate_message);
            if($validasi->fails())
            {
                return response()->json($validasi->errors());
            }

            // memproses inputan
            if ($keberadaan == 'Ada') {
                $kondisi = StatusApd::tryFrom($kondisi)->value;
                $gambar = $this->prosesGambar($r);
            } else if ($keberadaan == 'Hilang') {
                $gambar = null;
                $kondisi = StatusApd::hilang()->value;
            } else if ($keberadaan == 'Belum Terima') {
                $gambar = null;
                $kondisi = StatusApd::belumTerima()->value;
            }

            $input = InputApd::create([
                'id_pegawai' => $id_pegawai,
                'id_periode' => $id_periode,
                'id_jenis' => $id_jenis,
                'id_apd' => ($id_apd == '') ? null : $id_apd,
                'size' => ($size == '') ? null : $size,
                'kondisi' => $kondisi,
                'image' => $gambar,
                'no_seri' => $no_seri,
                'komentar_pengupload' => $komentar,
                'data_diupdate' => now(),
                'verifikasi_status' => VerifikasiApd::verifikasi()->value, // status verifikasi : proses
                'index_duplikat' => $index_duplikat,
                'keterangan_jenis_apd_template' => $keterangan
            ]);

            // untuk mencegah adanya duplikat
            $terinput = InputApd::where('id_pegawai',$id_pegawai)->where('id_periode',$id_periode)->where('keterangan_jenis_apd_template',$keterangan)->get();

            foreach($terinput as $t)
            {
                if($t->id_inputan != $input->id_inputan)
                    InputApd::find($t->id_inputan)->delete();
            }   

            return response()->json([
                "status" => true,
                "message" => "Berhasil menyimpan data.",
            ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menyimpan data.",
                // "error" => $e
            ],500);
        }
    }

    /**
     * Update data apd spesifik yang pernah diinput oleh pegawai.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateApdInput(Request $r)
    {

        /**
         * Memiliki 2 state :
         * - Admin belum men-verif inputan saat pegawai melakukan update data ---> update record seperti biasa
         * - Admin sudah men-verif inputan saat pegawai melakukan update data ---> masukan ke tabel sementara
         * 
         * untuk parameter, silahkan refer ke method simpanApdInput
         */

        try{

            // parameter inputan
            $keberadaan = $r->input('keberadaan');
            $id_periode = $r->input('id_periode');
            $id_jenis = $r->input('id_jenis');
            $id_apd = $r->input('id_apd');
            $id_pegawai = $r->input('id_pegawai');
            $size = $r->input('size');
            $kondisi = $r->input('id_periode');
            $no_seri = $r->input('no_seri');
            $komentar = $r->input('komentar');
            $keterangan = $r->input('keterangan'); // identifier tambahan pada record db
            $index_duplikat = $r->input('index_duplikat');

            // untuk mengubah validasi
            $perlu_input_size = $r->input('perlu_input_size');
            $input_no_seri = $r->input('input_no_seri');
            $strict_no_seri = $r->input('no_seri_strict');
            $this->ubahParameterValidasi($perlu_input_size,$input_no_seri,$strict_no_seri);

            // proses validasi inputan
            $validasi = Validator::make($r,$this->validate_rule,$this->validate_message);
            if($validasi->fails())
            {
                return response()->json($validasi->errors());
            }

            // cari inputan dari database
            $inputan = InputApd::query()->where('id_pegawai', $id_pegawai)
                ->where('id_periode', $id_periode)
                ->where('id_jenis', $id_jenis);

            if(!is_null($index_duplikat))
                $inputan = $inputan->where('index_duplikat',$index_duplikat);

            $inputan = $inputan->first();

            // apakah inputan sudah di validasi oleh admin
            $reupload = VerifikasiApd::tryFrom($inputan->verifikasi_status) == VerifikasiApd::terverifikasi();

            // memproses inputan
            if ($keberadaan == 'Ada') {
                $kondisi = StatusApd::tryFrom($kondisi)->value;
                $gambar = $this->prosesGambar($r,$reupload);
            } else if ($keberadaan == 'Hilang') {
                $gambar = null;
                $kondisi = StatusApd::hilang()->value;
            } else if ($keberadaan == 'Belum Terima') {
                $gambar = null;
                $kondisi = StatusApd::belumTerima()->value;
            }

            if($reupload)
            {
                // jika inputan sudah di validasi oleh admin, maka masukan ke tabel sementara

                // flag inputan tsb terlebih dahulu agar terlihat status minta update di tampilan menu utama / menu apdku
                $inputan->verifikasi_status = VerifikasiApd::mintaUpdate()->value;
                $inputan->save();

                // cari inputan di tabel sementara, jika belum ada maka bikin baru di tabel sementara
                $id_inputan = $inputan->id_inputan;


                $inputan = InputApdReupload::where('id_inputan', $id_inputan)
                            ->where('verifikasi_status', VerifikasiApd::verifikasi()->value) // masih belum diverifikasi
                            ->where('selesai',null) // belum selesai
                            ->first();

                if (is_null($inputan)) {
                    $inputan = new InputApdReupload;
                    $inputan->id_inputan = $id_inputan;
                }

                $inputan->id_apd = $id_apd;
                $inputan->size = $size;
                $inputan->kondisi = $kondisi;
                $inputan->image = $gambar;
                $inputan->no_seri = $no_seri;
                $inputan->komentar_pengupload = $komentar;
                $inputan->data_diupdate = now();
                $inputan->keterangan_jenis_apd_template = $keterangan;
                $inputan->verifikasi_status = VerifikasiApd::verifikasi()->value; // agar status terlihat belum diverifikasi admin di tampilan menu upload ulang apd
                $inputan->save();
            }
            else
            {
                // jika belum, maka update seperti biasa
                $inputan->id_apd = $id_apd;
                $inputan->size = $size;
                $inputan->no_seri = $no_seri;
                $inputan->kondisi = $kondisi;
                $inputan->image = $gambar;
                $inputan->komentar_pengupload = $komentar;
                $inputan->data_diupdate = now();
                $inputan->verifikasi_status = VerifikasiApd::verifikasi()->value;
                $inputan->keterangan_jenis_apd_template = $keterangan;
                $inputan->save();
            }

            return response()->json([
                "status" => true,
                "message" => "Berhasil menyimpan data.",
            ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menampilkan data.",
                // "error" => $e
            ],500);
        }
    }

    /**
     * Untuk melakukan penghapusan data apd yang telah diinput oleh pegawais.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteApdTerinput(Request $r)
    {
        try{
            $id = $r->inputan('id_inputan');
            $inputan = InputApd::find($id);

            $gambars = explode('||',$inputan->image);
            $id_jenis = $inputan->id_jenis;
            $id_periode = $inputan->id_periode;
            $id_pegawai = $inputan->id_pegawai;

            $fc = new FileController;
            foreach($gambars as $g)
            {
                Storage::delete($fc->buatPathFileApdUpload($id_pegawai,$id_jenis,$id_periode).'/'.$g);
            }

            $inputan->delete();

            return response()->json([
                "status" => true,
                "message" => "Berhasil menghapus data.",
            ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menampilkan data.",
                // "error" => $e
            ],500);
        }
    }
#endregion

#region CRUD Admin

    /**
     * Untuk populate dropdown wilayah dengan penempatan dibawah jurisdiksi admin
     */
    public function populateDropdownWilayah(Request $r)
    {

        /**
         * Hanya admin dinas saja yang dapat memilih wilayah
         */

        try{


            array_push($opsi_dropdown_wilayah, [
                "value" => 'semua', "text" => 'Semua Wilayah'
            ]);

            if ($r->user('sanctum')->hasAbility('admin_dinas')) {
                $fetch_wilayah = Wilayah::all();
            }

            if (!is_null($fetch_wilayah))
                foreach ($fetch_wilayah as $f) {
                    array_push($opsi_dropdown_wilayah, [
                        "value" => $f->id_wilayah, "text" => $f->nama_wilayah
                    ]);
                }

            return response()->json([
                "data"=>$opsi_dropdown_wilayah
            ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "data"=>null
            ]);
        }
    }

    /**
     * Untuk populate dropdown penempatan dengan penempatan dibawah jurisdiksi admin
     */
    public function populateDropdownPenempatan(Request $r)
    {
        try{


            $opsi_dropdown_penempatan = [];
            $target_wilayah = $r->input('id_wilayah');
            $target_penempatan = $r->input('id_penempatan'); // diisi penempatan admin

            array_push($opsi_dropdown_penempatan, [
                "value" => 'semua', "text" => 'Semua Penempatan'
            ]);

            $fetch_penempatan = Penempatan::where('id_wilayah', $target_wilayah)
                                            ->where('id_penempatan','like', $target_penempatan.'%')
                                            ->get()->all();

            if (!is_null($fetch_penempatan))
                foreach ($fetch_penempatan as $f) {
                    array_push($opsi_dropdown_penempatan, [
                        "value" => $f->id_penempatan, "text" => $f->nama_penempatan
                    ]);
                }

            return response()->json([
                    "data"=>$opsi_dropdown_penempatan
                ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "data"=>null
            ]);
        }
    }

    /**
     * Untuk mengambil data dari keseluruhan inputan pegawai yang menjadi tanggung jawab admin
     */
    public function indexDataApd(Request $r)
    {
        try{
            $target_wilayah = $r->input('id_wilayah');
            $target_penempatan = $r->input('id_penempatan');
            $target_periode = $r->input('id_periode');
            $list_pegawai = Pegawai::where('id_wilayah', $target_wilayah)
                                ->where('id_penempatan','like', $target_penempatan.'%')
                                ->get()->all();
            $adc = new ApdDataController;

            $data = [];

            foreach($list_pegawai as $p)
            {
                $list_inputan = $adc->muatInputanPegawai($target_periode, $p->id_pegawai);
                array_merge($data,$list_inputan);
            }
            

            return response()->json([
                "status" => true,
                "message" => "Menampilkan data apd yang pernah diinput",
                "data"=>$data
            ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menampilkan data.",
                // "error" => $e
            ],500);
        }
    }

    /**
     * Untuk mengambil data keseluruhan inputan yang di ubah setelah admin menyetujui verifikasi
     */
    public function indexDataApdReupload(Request $r)
    {
        try{

            // ambil input reupload yang belum di setujui dan belum selesai
            $list_reupload = InputApdReupload::where('verifikasi_status','!=',VerifikasiApd::terverifikasi()->value)
                                                ->where('selesai',null)
                                                ->get();
            
            if(is_null($list_reupload))
                return response()->json([
                    "status" => true,
                    "message" => "Tidak ada data yang dapat ditampilkan.",
                    "data"=>[]
                ]);

            // ambil pegawai di bawah tanggung jawabnya
            $target_wilayah = $r->input('id_wilayah');
            $target_penempatan = $r->input('id_penempatan');
            $list_pegawai = Pegawai::where('id_wilayah', $target_wilayah)
                                ->where('id_penempatan','like', $target_penempatan.'%')
                                ->pluck('id_pegawai');

            
            $adc = new ApdDataController;

            $data = [];

            foreach($list_reupload as $lr)
            {
                if(in_array($lr->inputan->id_pegawai,$list_pegawai))
                    $data[] = $adc->muatSatuInputanReupload($lr->id_reupload);
            }
            

            return response()->json([
                "status" => true,
                "message" => "Menampilkan data apd yang pernah diinput",
                "data"=>$data
            ]);


        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menampilkan data.",
                "data" => []
                // "error" => $e
            ],500);
        }
    }

    /**
     * Tindakan admin untuk melakukan verifikasi dari inputan yang dilakukan pegawai
     */
    public function verifikasiInputan(Request $r)
    {

        /**
         * Untuk value dari verifikasi mengikuti enum VerifikasiApd : 
         * - 1-> input (status default, dimana user berada di proses input yg artinya user belum input)
         * - 2 -> verifikasi (menunggu verifikasi, artinya user sudah input tapi belum di verifikasi admin)
         * - 3 -> terverifikasi (inputan user disetujui admin)
         * - 4 -> tertolak (inputan user ditolak admin)
         * - 5 -> mintaUpdate (ketika user meminta update untuk inputan yang sudah disetujui admin)
         * 
         * verifikasi menggunakan spatie enum, dokumentasi dapat dilihat di 
         * https://github.com/spatie/enum?tab=readme-ov-file#usage
         */

        try{

            $id_inputan = $r->input("id_inputan");
            $verifikasi = $r->input("verifikasi");
            $komentar = $r->input("komentar");
            $id_admin = $r->user('sanctum')->id;

            $adc = new ApdDataController;
            if($adc->adminVerifikasiInputan($id_inputan,$verifikasi,$komentar,$id_admin))
                return response()->json([
                    "status" => true,
                    "message" => "Berhasil merubah status verifikasi inputan pegawai.",
                ]);
            else
                throw new Exception('gagal');

        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat mengubah verifikasi inputans.",
                // "error" => $e
            ],500);
        }
    }

    /**
     * Verifikasi perubahan data inputan yang diajukan pegawai setelah sebelumnya inputan tersebut sudah di setujui oleh admin
     */
    public function verifikasiReupload(Request $r)
    {
        try{

            $id_reupload = $r->input("id_reupload");
            $verifikasi = $r->input("verifikasi");
            $komentar = $r->input("komentar");
            $id_admin = $r->user('sanctum')->id;

            $adc = new ApdDataController;
            if($adc->adminVerifikasiInputanReupload($id_reupload,$verifikasi,$komentar,$id_admin))
                return response()->json([
                    "status" => true,
                    "message" => "Berhasil merubah status verifikasi inputan pegawai.",
                ]);
            else
                throw new Exception('gagal');

            return response()->json([
                "status" => true,
                "message" => "Menampilkan data apd yang pernah diinput",
                // "data"=>$inputan
            ]);

        }
        catch(Throwable $e)
        {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan saat menampilkan data.",
                // "error" => $e
            ],500);
        }
    }


#endregion

#region Method Lain
    /**
     * Untuk memproses gambar yang diupload
     * @param Request $r file dan beberapa parameter untuk penamaan dan penempatan file di server
     * @param bool $reupload saat ini memproses gambar inputan yang sudah terverifikasi oleh admin?
     * @return string nama file gambar untuk disimpan di db
     */
    public function prosesGambar(Request $r, $reupload = false)
    {
        try{
            
            if($r->hasFile('upload_image'))
            {
                $image = $r->file('upload_image');
                $id_periode = $r->input('id_periode');
                $id_jenis = $r->input('id_jenis');
                $id_apd = $r->input('id_apd');
                $id_pegawai = $r->input('id_pegawai');

                $fc = new FileController;
                $adc = new ApdDataController;

                $img_count = count($image);
                //upload banyak
                if($img_count > 1)
                {
                    if ($img_count < $adc::$jumlahBatasUploadGambar)
                        $jumlah_gambar = $img_count;
                    else
                        $jumlah_gambar = $adc::$jumlahBatasUploadGambar;

                    $files = [];
                    for($i = 0; $i < $jumlah_gambar; $i++)
                    {
                        $nama_file = $fc->prosesNamaFileApdUpload($id_pegawai,$id_apd,null,$i,$id_periode);
                        $path_file = $fc->buatPathFileApdUpload($id_pegawai,$id_jenis,$id_periode,$reupload);

                        Storage::putFileAs($path_file,$image[$i],$nama_file);
                        $files[] = $nama_file;
                    }

                    return implode("||",$files);
                }
                //upload satu
                else
                {
                    $nama_file = $fc->prosesNamaFileApdUpload($id_pegawai,$id_apd,null,null,$id_periode);
                    $path_file = $fc->buatPathFileApdUpload($id_pegawai,$id_jenis,$id_periode,$reupload);

                    Storage::putFileAs($path_file,$image,$nama_file);

                    return $nama_file;
                }
            }

            return null;

        }
        catch(Throwable $e)
        {
            return null;
        }
    }

    /**
     * Untuk mengubah aturan validasi pada saat inputan apd
     * @param mixed $input_ukuran opsi dropdown, boolean, atau value yang menandakan bahwa pegawai perlu input ukuran apd
     * @param bool $input_no_seri apakah user perlu input no seri apd mereka
     * @param bool $no_seri_strict apakah inputan no seri bersifat strict
     */
    public function ubahParameterValidasi($input_ukuran = null, $input_no_seri = false, $no_seri_strict = false)
    {
        if(!is_null($input_ukuran) || (is_bool($input_ukuran) && $input_ukuran))
        {
            $this->validate_rule['size'] = 'required';
            $this->validate_message['size.required'] = 'Harap pilih ukuran APD anda.';
        }

        if($input_no_seri)
        {
            $this->validate_rule['no_seri'] = 'required';
            $this->validate_message['no_seri.required'] = 'Harap masukan no seri dari APD anda, jika tidak ada maka isi dengan tanda garis (-).';
        }

        if($no_seri_strict)
        {
            // TODO : masukan rule dan message untuk no seri strict jika aturan sudah diterapkan
        }
    }
#endregion
}
