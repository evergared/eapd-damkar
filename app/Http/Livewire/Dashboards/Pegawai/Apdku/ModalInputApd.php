<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Apdku;

use App\Enum\VerifikasiApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\InputApd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class ModalInputApd extends Component
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
            ['value'=> 'ada', 'text' => 'Sudah Terima dan Ada'],
            ['value'=> 'hilang', 'text' => 'Sudah Terima Tapi Hilang'],
            ['value'=> 'belum terima', 'text' => 'APD Belum Diterima'],
        ],
        $opsi_dropdown_size_apd = [],
        $opsi_dropdown_list_apd = [],
        $opsi_dropdown_kondisi_apd = [];

    // untuk diisi oleh user saat ini
    public  $id_apd_user = '',
            $size_apd_user = '',
            $kondisi_apd_user = '',
            $gambar_apd_user = [],
            $komentar_apd_user ="",
            $status_keberadaan_apd_user = "";
    
    // data dari tabel input_apd
    public  $terakhir_diisi = '',
            $terakhir_diverif = '',
            $id_apd_user_sebelum = '',
            $nama_apd_user_sebelum = '',
            $size_apd_user_sebelum = '',
            $kondisi_apd_user_sebelum = '',
            $gambar_apd_user_sebelum = null,
            $komentar_apd_user_sebelum ="",
            $status_keberadaan_apd_user_sebelum = "",
            $komentar_verifikator = "",
            $status_verifikasi = 1, // default value jika user belum pernah input
            $label_verifikasi = "Proses Input"; // default value jika user belum pernah input

    // cache untuk reset value ke kondisi sebelumnya
    public  $cache_id_apd_user = '',
            $cache_size_apd_user = '',
            $cache_kondisi_apd_user = '',
            $cache_komentar_apd_user = '';

    // untuk warna label bootstrap
    public  $warna_kerusakan = '',
            $warna_keberadaan ='',
            $warna_verifikasi ='secondary';

    // untuk komparasi status verifikasi pada view
    public 
        $enum_verifikasi_apd_input,
        $enum_verifikasi_apd_verifikasi,
        $enum_verifikasi_apd_terverifikasi;
    
    // utk mempermudah pemanggilan di blade.php
    public 
        $placeholder_path = '',
        $upload_path = '';

    // timestamp utk membantu troubleshoot, sebagai referensi waktu di log
    public  
        $error_time_gambar_template = '',
        $error_time_simpan_inputan = '';

    protected $listeners = [
        'panggilModalInput'
    ];

    #region Livewire Lifecycle
    public function render()
    {
        return view('livewire.dashboards.pegawai.apdku.modal-input-apd');
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

    public function panggilModalInput($value)
    {
        $this->inisiasiModalInput($value["id_jenis"]);
        $this->dispatchBrowserEvent('pangilModalInput');
    }

    public function panggilModalPreviewGambarUpload()
    {
        $this->dispatchBrowserEvent('panggilModalPreview');
    }

    public function inisiasiModalInput($id_jenis_apd)
    {
        $fc = new FileController;
        $pic = new PeriodeInputController;
        $adc = new ApdDataController;

        $this->placeholder_path = $fc::$apdPlaceholderBasePath;

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
        $this->gambar_apd_user = null;
        $this->komentar_apd_user ="";
        $this->status_keberadaan_apd_user = "";
    
        $this->terakhir_diisi = '';
        $this->terakhir_diverif = '';
        $this->id_apd_user_sebelum = '';
        $this->nama_apd_user_sebelum = '';
        $this->size_apd_user_sebelum = '';
        $this->kondisi_apd_user_sebelum = '';
        $this->gambar_apd_user_sebelum = null;
        $this->komentar_apd_user_sebelum ="";
        $this->status_keberadaan_apd_user_sebelum = "";
        $this->komentar_verifikator = "";
        $this->status_verifikasi = VerifikasiApd::input()->value;
        $this->label_verifikasi = VerifikasiApd::input()->label;

        $this->cache_id_apd_user = '';
        $this->cache_size_apd_user = '';
        $this->cache_kondisi_apd_user = '';
        $this->cache_komentar_apd_user = '';

        $this->warna_kerusakan = '';
        $this->warna_keberadaan ='';
        $this->warna_verifikasi ='secondary';

        $this->enum_verifikasi_apd_input = VerifikasiApd::input()->value;
        $this->enum_verifikasi_apd_verifikasi = VerifikasiApd::verifikasi()->value;
        $this->enum_verifikasi_apd_terverifikasi = VerifikasiApd::terverifikasi()->value;

        $this->error_time_gambar_template = '';
        $this->error_time_simpan_inputan = '';

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

        }
        // jika belum input
        elseif(is_null($inputan_sebelumnya))
        {

        }
        // jika sudah input
        else
        {
            $this->nama_apd_user_sebelum = ApdList::where('id_apd', $this->id_apd_user)->first()->nama_apd;

            $this->terakhir_diisi = $inputan_sebelumnya['data_terakhir_update'];
            $this->terakhir_diverif = $inputan_sebelumnya['verifikasi_terakhir_update'];
            $this->id_apd_user_sebelum = $inputan_sebelumnya['id_apd'];
            $this->size_apd_user_sebelum = $inputan_sebelumnya['size_apd'];
            $this->kondisi_apd_user_sebelum = $inputan_sebelumnya['status_kerusakan'];
            $this->gambar_apd_user_sebelum = $inputan_sebelumnya['gambar_apd'];
            $this->komentar_apd_user_sebelum = $inputan_sebelumnya['komentar_pengupload'];
            $this->status_keberadaan_apd_user_sebelum = $inputan_sebelumnya['status_keberadaan'];
            $this->komentar_verifikator = $inputan_sebelumnya['komentar_verifikator'];
            $this->status_verifikasi = $inputan_sebelumnya['enum_verifikasi'];
            $this->label_verifikasi = $inputan_sebelumnya['status_verifikasi'];

            $this->warna_kerusakan = $inputan_sebelumnya['warna_kerusakan'];
            $this->warna_verifikasi = $inputan_sebelumnya['warna_verifikasi'];
            $this->warna_keberadaan = $inputan_sebelumnya['warna_keberadaan'];
        }
        
    }

    public function inisiasiModalPreviewGambarUpload()
    {

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
                error_log("Modal Input Apd @ Dashboard Apdku Pegawai Error : Kesalahan saat iterasi list apd ".$e);
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
            error_log("Modal Input Apd @ Dashboard Apdku Pegawai Error : Kesalahan saat refresh option dropdown kondisi apd ".$e);
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
            error_log("Modal Input Apd @ Dashboard Apdku Pegawai Error : Kesalahan saat refresh option dropdown size apd ".$e);
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
            error_log("Modal Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_gambar_template."): Kesalahan saat refresh gambar template apd ".$e);
            Log::error("Modal Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_gambar_template."): Kesalahan saat refresh gambar template apd ".$e);
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

            

        }
        catch(Throwable $e)
        {
            $this->error_time_simpan_inputan = now();
            error_log("Modal Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_simpan_inputan."): Kesalahan saat menyimpan inputan ".$e);
            Log::error("Modal Input Apd @ Dashboard Apdku Pegawai Error (".$this->error_time_simpan_inputan."): Kesalahan saat menyimpan inputan ".$e);
            session()->flash('alert-danger','Gagal menyimpan data inputan APD ('.$this->error_time_simpan_inputan.')');
        }
    }

    public function update()
    {

    }

    public function updateTerverifikasi()
    {

    }
    #endregion

    #region Validasi
    public function validasiInputan()
    {
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
    #endregion

}
