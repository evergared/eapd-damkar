<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Apdku;

use App\Enum\StatusApd;
use App\Enum\VerifikasiApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\InputApd;
use App\Models\InputApdReupload;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class KendaliInputApd extends Component
{
    use WithFileUploads;

    // untuk menampung data dari template
    public 
        $template_id_jenis_apd = "",
        $template_nama_jenis_apd = "",
        $template_nama_apd = "",
        $template_data_apd = [], 
        $template_opsi_apd = [],
        $template_gambar_apd = [];
    
    // untuk dropdown keberadaan apd
    public 
        $opsi_dropdown_keberadaan = [
            ['value'=> 'Ada', 'text' => 'Sudah Terima dan Ada'],
            ['value'=> 'Hilang', 'text' => 'Sudah Terima Tapi Hilang'],
            ['value'=> 'Belum Terima', 'text' => 'APD Belum Diterima'],
        ],
        $opsi_dropdown_size_apd = [],
        $opsi_dropdown_list_apd = [],
        $opsi_dropdown_kondisi_apd = [];

    // untuk diisi oleh user saat ini
    public  $id_apd_user = '',
            $size_apd_user = '',
            $kondisi_apd_user = '',
            $no_seri_apd_user = '',
            $gambar_apd_user = [],
            $komentar_apd_user ="",
            $status_keberadaan_apd_user = "";
    
    // data dari tabel input_apd
    public  $terakhir_diisi = '',
            $terakhir_diverif = '',
            $id_apd_user_sebelum = '',
            $id_inputan_user_sebelum = '',
            $nama_apd_user_sebelum = '',
            $size_apd_user_sebelum = '',
            $kondisi_apd_user_sebelum = '',
            $no_seri_apd_user_sebelum = '',
            $gambar_apd_user_sebelum = null,
            $komentar_apd_user_sebelum ="",
            $status_keberadaan_apd_user_sebelum = "",
            $label_kerusakan = "",
            $komentar_verifikator = "",
            $jabatan_verifikator = "",
            $nama_verifikator = "",
            $status_verifikasi = 1, // default value jika user belum pernah input
            $label_verifikasi = "Proses Input"; // default value jika user belum pernah input
    
    public 
            $id_apd_user_reupload = '',
            $nama_apd_user_reupload = '',
            $size_apd_user_reupload = '',
            $kondisi_apd_user_reupload = '',
            $label_kondisi_apd_user_reupload = '',
            $warna_kondisi_apd_user_reupload = '',
            $image_apd_user_reupload = null,
            $no_seri_apd_user_reupload = '',
            $komentar_apd_user_reupload = '',
            $data_diupdate_reupload = null;


    // cache untuk reset value ke kondisi sebelumnya
    public  $cache_id_apd_user = '',
            $cache_size_apd_user = '',
            $cache_kondisi_apd_user = '',
            $cache_komentar_apd_user = '';

    // untuk warna label bootstrap
    public  $warna_kerusakan = '',
            $warna_kondisi_reupload = '',
            $warna_keberadaan ='',
            $warna_verifikasi ='secondary';

    // untuk komparasi status verifikasi pada view
    public 
        $enum_verifikasi_apd_input,
        $enum_verifikasi_apd_verifikasi,
        $enum_verifikasi_apd_terverifikasi;

    // untuk menampilkan elemen tersembunyi
    public 
        $show_ajukan_perubahan = false,
        $show_data_perubahan_pending = false,
        $show_input_no_seri = false,
        $show_gambar_reupload = false,
        $show_input_no_seri_strict = false;
    
    // utk mempermudah pemanggilan di blade.php
    public 
        $placeholder_path = '',
        $upload_path = '';

    // timestamp utk membantu troubleshoot, sebagai referensi waktu di log
    public  
        $error_time_gambar_template = '',
        $error_time_inisiasi_modal = '',
        $error_time_simpan_inputan = '';

    protected $listeners = [
        'panggilKendaliInput'
    ];

    #region Livewire Lifecycle
    public function render()
    {
        return view('livewire.dashboards.pegawai.apdku.kendali-input-apd');
    }

    public function updated($property)
    {
        $this->validateOnly(
            $property,
            [
                'gambar_apd_user.*' => ['image', 'size:256'], //5120 //256
                'gambar_apd_user' => ['max:3'] //5120 //256
            ],
            [
                'gambar_apd_user.*.image' => 'File harus berupa gambar.',
                'gambar_apd_user.*.size' => 'Ukuran melebihi batas maksimal (5 Mb).',
                // 'gambar_apd_user.image' => 'File harus berupa gambar.',
                'gambar_apd_user.max' => 'Jumlah file terlalu banyak (maks :max).',
                'gambar_apd_user.required' => 'Gambar belum dimasukan.'
            ]
        );
    }
    #endregion

    public function panggilKendaliInput($value)
    {
        $this->inisiasiKendaliInput($value["id_jenis"]);
        $this->dispatchBrowserEvent('butuh-input-ke-kendali-input');
    }

    public function inisiasiKendaliInput($id_jenis_apd)
    {
        try{

            $this->error_time_inisiasi_modal = '';

            $fc = new FileController;
            $pic = new PeriodeInputController;
            $adc = new ApdDataController;

            $this->placeholder_path = $fc::$apdPlaceholderBasePath;
            $this->upload_path = 'storage/';

            $this->template_id_jenis_apd = $id_jenis_apd;
            $this->template_nama_jenis_apd = ApdJenis::where('id_jenis',$this->template_id_jenis_apd)->first()->nama_jenis;

            // kosongkan data sebelumnya (jika ada)
            $this->template_nama_apd = "";
            $this->template_data_apd = []; 
            $this->template_opsi_apd = [];
            $this->template_gambar_apd = array();
            
            $this->id_apd_user = '';
            $this->size_apd_user = '';
            $this->kondisi_apd_user = '';
            $this->no_seri_apd_user = '';
            $this->gambar_apd_user = null;
            $this->komentar_apd_user ="";
            $this->status_keberadaan_apd_user = "";
        
            $this->terakhir_diisi = '';
            $this->terakhir_diverif = '';
            $this->id_apd_user_sebelum = '';
            $this->nama_apd_user_sebelum = '';
            $this->size_apd_user_sebelum = '';
            $this->kondisi_apd_user_sebelum = '';
            $this->no_seri_apd_user_sebelum = '';
            $this->gambar_apd_user_sebelum = null;
            $this->komentar_apd_user_sebelum ="";
            $this->status_keberadaan_apd_user_sebelum = "";
            $this->id_inputan_user_sebelum = '';
            $this->label_kerusakan = "";
            $this->komentar_verifikator = "";
            $this->status_verifikasi = VerifikasiApd::input()->value;
            $this->label_verifikasi = VerifikasiApd::input()->label;
            $this->jabatan_verifikator = "";
            $this->nama_verifikator = "";

            $this->cache_id_apd_user = '';
            $this->cache_size_apd_user = '';
            $this->cache_kondisi_apd_user = '';
            $this->cache_komentar_apd_user = '';

            $this->warna_kerusakan = '';
            $this->warna_keberadaan ='';
            $this->warna_verifikasi ='secondary';

            $this->id_apd_user_reupload = '';
            $this->nama_apd_user_reupload = '';
            $this->size_apd_user_reupload = '';
            $this->kondisi_apd_user_reupload = '';
            $this->warna_kondisi_apd_user_reupload = '';
            $this->label_kondisi_apd_user_reupload = '';
            $this->image_apd_user_reupload = null;
            $this->no_seri_apd_user_reupload = '';
            $this->komentar_apd_user_reupload = '';
            $this->data_diupdate_reupload = null;

            $this->enum_verifikasi_apd_input = VerifikasiApd::input()->value;
            $this->enum_verifikasi_apd_verifikasi = VerifikasiApd::verifikasi()->value;
            $this->enum_verifikasi_apd_terverifikasi = VerifikasiApd::terverifikasi()->value;

            $this->error_time_gambar_template = '';
            $this->error_time_simpan_inputan = '';
            $this->show_data_perubahan_pending = false;

            // bangun data template apd untuk modal
            $list_apd_terkait = $adc->muatOpsiApd($this->template_id_jenis_apd);

            $this->template_opsi_apd = $list_apd_terkait['opsi_apd'];
            $this->template_data_apd = $adc->bangunItemModalInputApd($this->template_opsi_apd);
            $this->refreshDropdownListApd();
            $this->refreshDropdownKondisiApd();
            $this->refreshDropdownSizeApd();

            // sesuaikan data dengan inputan sebelumnya (jika ada)
            $inputan_sebelumnya = $adc->muatSatuInputanPegawai($this->template_id_jenis_apd);

            // jika terjadi error saat memuat
            if(is_bool($inputan_sebelumnya))
            {
                $this->error_time_inisiasi_modal = now();
                error_log("Kendali Input Apd @ Dashboard Apdku Pegawai (".$this->error_time_inisiasi_modal.") Error : Kesalahan memuat satu inputan pegawai saat inisiasi modal.");
                Log::error("Kendali Input Apd @ Dashboard Apdku Pegawai (".$this->error_time_inisiasi_modal.") Error : Kesalahan memuat satu inputan pegawai saat inisiasi modal.");

            }
            // jika belum input
            elseif(is_null($inputan_sebelumnya))
            {

            }
            // jika sudah input
            else
            {

                $this->status_keberadaan_apd_user = $this->status_keberadaan_apd_user_sebelum = $inputan_sebelumnya['status_keberadaan'];
                $this->terakhir_diisi = $inputan_sebelumnya['data_terakhir_update'];
                $this->terakhir_diverif = $inputan_sebelumnya['verifikasi_terakhir_update'];
                $this->id_apd_user = $this->id_apd_user_sebelum = $inputan_sebelumnya['id_apd'];
                $this->size_apd_user = $this->size_apd_user_sebelum = ($inputan_sebelumnya['size_apd'] == '-')? "" : $inputan_sebelumnya['size_apd'];
                $this->no_seri_apd_user = $this->no_seri_apd_user_sebelum = $inputan_sebelumnya['no_seri'];
                $this->kondisi_apd_user = $this->kondisi_apd_user_sebelum = StatusApd::tryFrom($inputan_sebelumnya['status_kerusakan'])->value;
                $this->gambar_apd_user_sebelum = $inputan_sebelumnya['gambar_apd'];
                $this->komentar_apd_user = $this->komentar_apd_user_sebelum = $inputan_sebelumnya['komentar_pengupload'];
                $this->komentar_verifikator = $inputan_sebelumnya['komentar_verifikator'];
                $this->status_verifikasi = $inputan_sebelumnya['enum_verifikasi'];
                $this->label_verifikasi = $inputan_sebelumnya['status_verifikasi'];
                $this->nama_apd_user_sebelum = ($this->id_apd_user_sebelum)? ApdList::where('id_apd', $this->id_apd_user_sebelum)->first()->nama_apd : '';
                $this->id_inputan_user_sebelum = $inputan_sebelumnya['id_inputan'];

                $this->jabatan_verifikator = $inputan_sebelumnya['jabatan_verifikator'];
                $this->nama_verifikator = $inputan_sebelumnya['nama_verifikator'];

                $this->warna_kerusakan = $inputan_sebelumnya['warna_kerusakan'];
                $this->warna_verifikasi = $inputan_sebelumnya['warna_verifikasi'];
                $this->warna_keberadaan = $inputan_sebelumnya['warna_keberadaan'];
                
                $this->label_kerusakan = StatusApd::tryFrom($this->kondisi_apd_user_sebelum)->label;

                $this->show_data_perubahan_pending = InputApdReupload::where('id_inputan',$this->id_inputan_user_sebelum)->where('selesai',false)->exists();

                $reupload = $adc->muatSatuInputanReupload($this->id_inputan_user_sebelum);

                if(!is_null($reupload))
                {
                    $this->id_apd_user_reupload = $reupload['id_apd'];
                    $this->nama_apd_user_reupload = $reupload['nama_apd'];
                    $this->size_apd_user_reupload = $reupload['size'];
                    $this->kondisi_apd_user_reupload = $reupload['kondisi_enum']->value;
                    $this->label_kondisi_apd_user_reupload = $reupload['kondisi_label'];
                    $this->warna_kondisi_apd_user_reupload = $reupload['kondisi_warna'];
                    $this->image_apd_user_reupload = $reupload['image'];
                    $this->no_seri_apd_user_reupload = $reupload['no_seri'];
                    $this->komentar_apd_user_reupload = $reupload['komentar_pengupload'];
                    $this->data_diupdate_reupload = $reupload['data_diupdate'];

                }


                $this->refreshDropdownListApd();
                $this->refreshGambarTemplate();
                
            }

        }
        catch(Throwable $e)
        {
            $this->error_time_inisiasi_modal = now();
                error_log("Kendali Input Apd @ Dashboard Apdku Pegawai (".$this->error_time_inisiasi_modal.") Error : Kesalahan saat inisiasi modal ".$e);
                Log::error("Kendali Input Apd @ Dashboard Apdku Pegawai (".$this->error_time_inisiasi_modal.") Error : Kesalahan saat inisiasi modal ".$e);
        }

        
        
    }

    #region Refresh data
    public function refreshDropdownListApd()
    {
        $this->opsi_dropdown_list_apd = [];
        foreach($this->template_opsi_apd as $opsi)
        {
            try{

                array_push($this->opsi_dropdown_list_apd, ['id_apd' => $opsi, 'nama_apd' => ApdList::where('id_apd', '=', $opsi)->value('nama_apd')]);

            }
            catch(Throwable $e)
            {
                error_log("Kendali Input Apd @ Dashboard Apdku Pegawai Error : Kesalahan saat iterasi list apd ".$e);
                continue;
            }
        }
    }

    public function refreshDropdownKondisiApd()
    {
        try{

            $this->opsi_dropdown_kondisi_apd = $this->template_data_apd[array_search($this->id_apd_user, $this->template_data_apd,true)]['kondisi_apd'];

        }
        catch(Throwable $e)
        {
            error_log("Kendali Input Apd @ Dashboard Apdku Pegawai Error : Kesalahan saat refresh option dropdown kondisi apd ".$e);
            $this->opsi_dropdown_kondisi_apd = [];
        }
    }

    public function refreshDropdownSizeApd()
    {
        try{

            $this->opsi_dropdown_size_apd = $this->template_data_apd[array_search($this->id_apd_user, $this->template_data_apd,true)]['size_apd'];

        }
        catch(Throwable $e)
        {
            error_log("Kendali Input Apd @ Dashboard Apdku Pegawai Error : Kesalahan saat refresh option dropdown size apd ".$e);
            $this->opsi_dropdown_size_apd = [];
        }
    }

    public function refreshGambarTemplate()
    {
        $this->error_time_gambar_template = "";
        $this->template_gambar_apd = null;

        try {
            $this->template_gambar_apd = $this->template_data_apd[array_search($this->id_apd_user, $this->template_data_apd,true)]['gambar_apd'];

        } catch (Throwable $e) {
            $this->error_time_gambar_template = now();
            $this->template_gambar_apd = false;
            error_log("Kendali Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_gambar_template."): Kesalahan saat refresh gambar template apd ".$e);
            Log::error("Kendali Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_gambar_template."): Kesalahan saat refresh gambar template apd ".$e);
        }
    }
    #endregion

    #region Wire:change Function
    public function changeDropdownListApd()
    {
        $this->size_apd_user = '';
        $this->kondisi_apd_user = '';
        $this->gambar_apd_user = null;
        $this->komentar_apd_user ="";

        $this->show_input_no_seri = false;
        $this->show_input_no_seri_strict = false;

        $apd = ApdList::find($this->id_apd_user);
        if(!is_null($apd))
        {
            $this->show_input_no_seri = $apd->input_no_seri;
            $this->show_input_no_seri_strict = $apd->strict_no_seri;

        }

        $this->refreshDropdownKondisiApd();
        $this->refreshDropdownSizeApd();
        $this->refreshGambarTemplate();
    }

    public function changeDropdownKeberadaan()
    {
        $this->id_apd_user = '';
        $this->size_apd_user = '';
        $this->kondisi_apd_user = '';
        $this->gambar_apd_user = null;
    }
    #endregion

    #region Button Function
    public function simpan()
    {
        $this->error_time_simpan_inputan = "";
        $this->validasiInputan();
        
        try{

            $pic = new PeriodeInputController;

            $id_pegawai = Auth::user()->data->id_pegawai;
            $periode = $pic->ambilIdPeriodeInput();

            $kondisi = null;
            $gambar = null;

            if($this->status_keberadaan_apd_user == 'Ada')
            {
                
                $kondisi = StatusApd::tryFrom($this->kondisi_apd_user)->value;
                $gambar = $this->prosesGambar();
            }
            else if($this->status_keberadaan_apd_user == 'Hilang')
            {
                $kondisi = StatusApd::hilang()->value;
            }
            else if($this->status_keberadaan_apd_user == 'Belum Terima')
            {
                $kondisi = StatusApd::belumTerima()->value;
            }

            InputApd::create([
                'id_pegawai' => $id_pegawai,
                'id_periode' => $periode,
                'id_jenis' => $this->template_id_jenis_apd,
                'id_apd' => ($this->id_apd_user == '')? null : $this->id_apd_user,
                'size' => ($this->size_apd_user == '')? null : $this->size_apd_user,
                'kondisi' => $kondisi,
                'image' => $gambar,
                'no_seri' => $this->no_seri_apd_user,
                'komentar_pengupload'=> $this->komentar_apd_user,
                'data_diupdate'=>now(),
                'verifikasi_status' => VerifikasiApd::verifikasi()->value
            ]);

            $this->inisiasiKendaliInput($this->template_id_jenis_apd);
            $this->emit('refreshComponent');
            session()->flash('alert-success', 'Inputan berhasil disimpan!');

        }
        catch(Throwable $e)
        {
            $this->error_time_simpan_inputan = now();
            error_log("Kendali Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_simpan_inputan."): Kesalahan saat menyimpan inputan ".$e);
            Log::error("Kendali Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_simpan_inputan."): Kesalahan saat menyimpan inputan ".$e);
            session()->flash('alert-danger','Gagal menyimpan data inputan APD (ref : '.$this->error_time_simpan_inputan.')');
        }
    }

    public function update()
    {
        $this->error_time_simpan_inputan = '';
        $this->validasiInputan();
        try{

            $pic = new PeriodeInputController;

            $id_pegawai = Auth::user()->data->id_pegawai;
            $periode = $pic->ambilIdPeriodeInput();

            $inputan = InputApd::where('id_pegawai', $id_pegawai)
                        ->where('id_periode', $periode)
                        ->where('id_jenis', $this->template_id_jenis_apd)
                        ->first();

            if(is_null($inputan))
                throw new Exception('Tidak ditemukan inputan dengan parameter id_pegawai : '.$id_pegawai.", id_periode : ".$periode.", id_jenis : ".$this->template_id_jenis_apd." pada tabel input_apd.");

            $kondisi = null;
            $gambar = null;

            if($this->status_keberadaan_apd_user == 'ada')
            {
                
                $kondisi = StatusApd::tryFrom($this->kondisi_apd_user)->value;
                $gambar = $this->prosesGambar();
            }
            else if($this->status_keberadaan_apd_user == 'hilang')
            {
                $kondisi = StatusApd::hilang()->value;
            }
            else if($this->status_keberadaan_apd_user == 'belum terima')
            {
                $kondisi = StatusApd::belumTerima()->value;
            }

            $inputan->id_apd = $this->id_apd_user;
            $inputan->size = $this->size_apd_user;
            $inputan->no_seri = $this->no_seri_apd_user;
            $inputan->kondisi = $kondisi;
            $inputan->image = $gambar;
            $inputan->komentar_pengupload = $this->komentar_apd_user;
            $inputan->data_diupdate = now();
            $inputan->verifikasi_status = $this->enum_verifikasi_apd_input;

            $inputan->save();
            $this->inisiasiKendaliInput($this->template_id_jenis_apd);
            $this->emit('refreshComponent');
            session()->flash('alert-success', 'Inputan berhasil diupdate!');

        }
        catch(Throwable $e)
        {
            $this->error_time_simpan_inputan = now();
            error_log("Kendali Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_simpan_inputan."): Kesalahan saat update inputan ".$e);
            Log::error("Kendali Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_simpan_inputan."): Kesalahan saat update inputan ".$e);
            session()->flash('alert-danger','Gagal mengupdate data inputan APD (ref : '.$this->error_time_simpan_inputan.')');
        }
    }

    public function updateTerverifikasi()
    {
        $this->error_time_simpan_inputan = '';
        $this->validasiInputan();
        try{

            $pic = new PeriodeInputController;

            $id_pegawai = Auth::user()->data->id_pegawai;
            $periode = $pic->ambilIdPeriodeInput();

            $inputan = InputApd::where('id_pegawai', $id_pegawai)
                        ->where('id_periode', $periode)
                        ->where('id_jenis', $this->template_id_jenis_apd)
                        ->first();

            if(is_null($inputan))
                throw new Exception('Tidak ditemukan inputan dengan parameter id_pegawai : '.$id_pegawai.", id_periode : ".$periode.", id_jenis : ".$this->template_id_jenis_apd." pada tabel input_apd.");
            
            $id_inputan = $inputan->id_inputan;

            $inputan = InputApdReupload::where('id_inputan',$id_inputan)->first();

            if(is_null($inputan))
            {   
                $inputan = new InputApdReupload;
                $inputan->id_inputan = $id_inputan;
            }
            
            $kondisi = null;
            $gambar = null;

            if($this->status_keberadaan_apd_user == 'Ada')
            {
                
                $kondisi = StatusApd::tryFrom($this->kondisi_apd_user)->value;
                $gambar = $this->prosesGambar(true);
            }
            else if($this->status_keberadaan_apd_user == 'Hilang')
            {
                $kondisi = StatusApd::hilang()->value;
            }
            else if($this->status_keberadaan_apd_user == 'Belum Terima')
            {
                $kondisi = StatusApd::belumTerima()->value;
            }


            $inputan->id_apd = $this->id_apd_user;
            $inputan->size = $this->size_apd_user;
            $inputan->kondisi = $kondisi;
            $inputan->image = $gambar;
            $inputan->no_seri = $this->no_seri_apd_user;
            $inputan->komentar_pengupload = $this->komentar_apd_user;
            $inputan->data_diupdate = now();

            $inputan->save();
            $this->inisiasiKendaliInput($this->template_id_jenis_apd);
            $this->emit('refreshComponent');
            session()->flash('alert-success', 'Inputan berhasil diupdate! Tunggu verifikasi Admin untuk perubahan yang dilakukan.');

        }
        catch(Throwable $e)
        {
            $this->error_time_simpan_inputan = now();
            error_log("Kendali Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_simpan_inputan."): Kesalahan saat update inputan pasca verifikasi diterima ".$e);
            Log::error("Kendali Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_simpan_inputan."): Kesalahan saat update inputan pasca verifikasi diterima ".$e);
            session()->flash('alert-danger','Gagal mengupdate data inputan APD (ref : '.$this->error_time_simpan_inputan.')');
        }
    }
    #endregion

    #region Proses Inputan
    public function validasiInputan()
    {

        $this->validate(
            [
                'status_keberadaan_apd_user' => 'required'
            ],
            [
                'status_keberadaan_apd_user.required' => 'Keberadaan APD perlu diisi.'
            ]
        );

        if($this->status_keberadaan_apd_user == "ada")
        {
            $this->validate(
                [
                    'id_apd_user' => 'required'
                ],
                [
                    'id_apd_user.required' => 'Harap pilih model APD'
                ]
            );

            if($this->show_input_no_seri)
            {
                $this->validate(
                    [
                        'no_seri_apd_user' => 'required'
                    ],
                    [
                        'no_seri_apd_user.required' => 'Harap masukan no seri APD'
                    ]
                );
            }

            if (!is_null($this->opsi_dropdown_size_apd)) {
                $this->validate(
                    [
                        'size_apd_user' => 'required'
                    ],
                    [
                        'size_apd_user.required' => 'Harap pilih ukuran APD'
                    ]
                );
            }

            if (!is_null($this->opsi_dropdown_kondisi_apd)) {
                $this->validate(
                    [
                        'kondisi_apd_user' => 'required'
                    ],
                    [
                        'kondisi_apd_user.required' => 'Harap pilih jenis kondisi APD'
                    ]
                );
            }

            
            $this->validate(
                [
                    'gambar_apd_user' => 'required'
                ],
                [
                    'gambar_apd_user.required' => 'Harap upload gambar APD'
                ]
            );
        }
    }

    public function prosesGambar($reupload = false) : string|null
    {
        $fc = new FileController;
        $pic = new PeriodeInputController;
        $adc = new ApdDataController;

        $id_pegawai = Auth::user()->data->id_pegawai;
        $periode = $pic->ambilIdPeriodeInput();

        try{

            if($this->gambar_apd_user)
                {
                    error_log("start upload gambar");
                    $list_gbr = [];

                    //upload banyak
                    if(count($this->gambar_apd_user) > 1)
                    {
                        // cek ada berapa gambar yang diupload
                        // jika melebihi batas, sesuaikan dengan nilai batas
                        $jumlah_gambar = 0;

                        if(count($this->gambar_apd_user) < $adc::$jumlahBatasUploadGambar)
                            $jumlah_gambar = count($this->gambar_apd_user);
                        else
                            $jumlah_gambar = $adc::$jumlahBatasUploadGambar;

                        // proses gambar terupload ke folder masing-masing
                        for ($i = 0; $i < $jumlah_gambar; $i++) {

                            $gbr_temp = $fc->prosesNamaFileApdUpload($id_pegawai, $this->id_apd_user, null, $i);

                            $this->gambar_apd_user[$i]->storeAs(
                                $fc->buatPathFileApdUpload($id_pegawai, $this->template_id_jenis_apd, $periode, $reupload),
                                $gbr_temp
                            );

                            array_push($list_gbr, $gbr_temp);
                        }
                    }
                    // upload 1
                    else
                    {

                        $gbr_temp = $fc->prosesNamaFileApdUpload($id_pegawai, $this->id_apd_user, null, 0);

                        $this->gambar_apd_user[0]->storeAs(
                            $fc->buatPathFileApdUpload($id_pegawai, $this->template_id_jenis_apd, $periode, $reupload),
                            $gbr_temp
                        );

                        array_push($list_gbr, $gbr_temp);

                    }

                    $g = implode("||",$list_gbr);
                    error_log('gambar terupload : '.$g);
                    return $g;
                    
                }

                return null;

        }
        catch(Throwable $e)
        {
            error_log("Kendali Input Apd @ Dashboard Apdku Pegawai Error : Kesalahan saat upload gambar apd ".$e);
            return null;
        }
    }
    #endregion

}
