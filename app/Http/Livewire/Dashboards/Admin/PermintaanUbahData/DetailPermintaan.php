<?php

namespace App\Http\Livewire\Dashboards\Admin\PermintaanUbahData;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\FileController;
use App\Models\InputApd;
use App\Models\InputApdReupload;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class DetailPermintaan extends Component
{

    public 
        $id_inputan = null;

    public
        $path_gambar = 'storage/';

    public
        $opsi_dropdown_terima = [
            ['value' => '1', 'text' =>'Setujui Perubahan'],
            ['value' => '0', 'text' =>'Tolak Perubahan'],
        ];
    
    public
        $model_terima = '',
        $model_komentar = '';

    public 
        $entry_detail = null,
        $entry_sebelumnya = null,
        $gambar_apd_template = null;

    public
        $error_time_page = null,
        $error_time_action = null;

    protected $listeners = [
        'panggilDetail'
    ];

    public function render()
    {
        return view('livewire.dashboards.admin.permintaan-ubah-data.detail-permintaan');
    }

    public function inisiasiDetail()
    {
        $this->entry_detail = null;
        $this->entry_sebelumnya = null;        
        $this->gambar_apd_template = null;
        $this->error_time_page = null;

        try{

            $inputan = InputApd::find($this->id_inputan)->first();
            if(is_null($inputan))
                throw new Exception('Inputan tidak ditemukan dengan id '.$this->id_inputan);



            $adc = new ApdDataController;

            $this->entry_sebelumnya = $adc->muatSatuInputanPegawai($inputan->id_jenis,null,$inputan->id_pegawai,$inputan->index_duplikat);
            $this->entry_detail = $adc->muatSatuInputanReupload($this->id_inputan);
            $this->gambar_apd_template = $adc->siapkanGambarTemplateBesertaPathnya((is_null($inputan->apd))? '' : $inputan->apd->image,$inputan->id_jenis, $inputan->id_apd);

        }
        catch(Throwable $e)
        {
            $this->error_time_page = now();
            $this->entry_detail = null;
            $this->entry_sebelumnya = null;            
            $this->gambar_apd_template = null;
            error_log('Detail Permintaan @ Dashboard Permintaan Ubah Data Admin ref ('.$this->error_time_page.') : Kesalahan saat inisiasi '.$e);
            Log::error('Detail Permintaan @ Dashboard Permintaan Ubah Data Admin ref ('.$this->error_time_page.') : Kesalahan saat inisiasi '.$e);
        }
    }

    public function panggilDetail($id)
    {
        $this->id_inputan = $id;
        $this->inisiasiDetail();
        $this->dispatchBrowserEvent('list-ke-detail');
    }

    public function simpan()
    {
        $this->error_time_action = null;

        $this->validate([
            'model_terima' => 'required'
        ],
        [
            'model_terima.required' => 'Pilih tindakan terlebih dahulu.'
        ]);

        try{

            $inputan_old = InputApd::find($this->id_inputan)->first();

            if(is_null($inputan_old))
                throw new Exception('Inputan tidak dapat ditemukan dengan id '.$this->id_inputan);
            
            $inputan_new = InputApdReupload::where('id_inputan',$this->id_inputan)->first();

            if(is_null($inputan_new))
                throw new Exception('Inputan Reupload tidak dapat ditemukan dengan id '.$this->id_inputan);

            if($this->model_terima == '1')
            {
                $fc = new FileController;

                $status = $fc->gantiGambarInputanDariReupload($this->id_inputan);

                if(!$status)
                    throw new Exception('Gagal dalam mengganti file gambar input_apd menjadi gambar input_apd_template');

                $inputan_old->id_apd = $inputan_new->id_apd;
                $inputan_old->size = $inputan_new->size;
                $inputan_old->no_seri = $inputan_new->no_seri;
                $inputan_old->kondisi = $inputan_new->kondisi;
                $inputan_old->image = $inputan_new->image;
                $inputan_old->komentar_pengupload = $inputan_new->komentar_pengupload;
                $inputan_old->data_diupdate = $inputan_new->data_diupdate;

                $admin = Auth::user();

                $time = now();

                $verifikator = '';
                $jabatan = '';

                if(!is_null($admin->id_pegawai) || !is_null($admin->id_pegawai_plt))
                {
                    $verifikator = (!is_null($admin->id_pegawai_plt))? $admin->plt->nama : $admin->data->nama;
                    $jabatan = (!is_null($admin->id_pegawai_plt))? $admin->plt->jabatan->nama_jabatan : $admin->data->jabatan->nama_jabatan;
                }

                $inputan_old->jabatan_verifikator = $jabatan;
                $inputan_old->verifikasi_oleh = $verifikator;
                $inputan_old->verifikasi_diupdate = $time;
                $inputan_old->save();
                $inputan_new->terima = true;

            }
            else{

                $inputan_new->terima = false;

            }

            

            $inputan_new->selesai = true;
            
            $inputan_new->save();
            $this->emit('refreshSidebar');
            session()->flash('alert-success','Berhasil menerapkan tindakan.');
            

        }
        catch(Throwable $e)
        {
            $this->error_time_action = now();
            $this->model_terima = null;
            $this->model_komentar = null;
            error_log('Detail Permintaan @ Dashboard Permintaan Ubah Data Admin ref ('.$this->error_time_action.') : Kesalahan saat menyimpan tindakan '.$e);
            Log::error('Detail Permintaan @ Dashboard Permintaan Ubah Data Admin ref ('.$this->error_time_action.') : Kesalahan saat menyimpan tindakan '.$e);
            session()->flash('alert-danger','Gagal dalam menerapkan tindakan. ref : ('.$this->error_time_action.')');
        }
    }

    public function kembali()
    {
        $this->dispatchBrowserEvent('detail-ke-list');
    }
}
