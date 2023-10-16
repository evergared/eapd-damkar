<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Progress\Apd;

use App\Http\Controllers\ApdDataController;
use App\Models\ApdList;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class ModalDetailProgressApd extends Component
{

    // value general
    public 
        $nama_pegawai = "",
        $id_pegawai = "",
        $id_periode = "",
        $list_inputan_pegawai = [],
        $path_gambar = 'storage/';

    // untuk tampilan gambar di card detail inputan
    public
        $gambar_terpilih = null, 
        $nama_apd_detail = "",
        $gambar_apd_template = null,
        $data_detail_inputan = null;
    
    // untuk data profil
    public 
        $profil_tampil = false,
        $profil_penempatan = "",
        $profil_nip = "",
        $profil_nrk = "",
        $profil_grup = "",
        $profil_foto = "";

    public $listeners = [
            'panggilModalDetail'
        ];

    public function render()
    {
        return view('livewire.dashboards.pegawai.progress.apd.modal-detail-progress-apd');
    }

    public function panggilModalDetail($value)
    {
        $this->inisiasiModal($value);
        $this->dispatchBrowserEvent("panggilModal",['id' => 'modal-detail']);
    }

    public function inisiasiModal($value)
    {
        try
        {
            $this->id_pegawai = $value[0];
            $this->nama_pegawai = Pegawai::find($this->id_pegawai)->nama;

            $adc = new ApdDataController;
            $this->id_periode = $adc->ambilIdPeriodeInput();
            $this->list_inputan_pegawai = $adc->muatInputanPegawai($this->id_periode,$this->id_pegawai);
            
        }
        catch(Throwable $e)
        {
            error_log('Modal Detail Progress @ Dashboard Progress Apd Anggota Pegawai error : '.$e);
            Log::error('Modal Detail Progress @ Dashboard Progress Apd Anggota Pegawai error : '.$e);
            $this->id_pegawai = "";
            $this->nama_pegawai = "-";
            session()->flash('alert-danger','Gagal memuat data untuk detail inputan pegawai.');
        }
    }

    public function lihatDetail($value)
    {
        $this->data_detail_inputan = null;
        if(array_key_exists($value,$this->list_inputan_pegawai))
        {
            $this->data_detail_inputan = $this->list_inputan_pegawai[$value];
            $this->nama_apd_detail = $this->data_detail_inputan['nama_jenis'];

            $apd = ApdList::where('id_apd', $this->data_detail_inputan['id_apd'])->first();
            if(!is_null($apd))
            {
                $adc = new ApdDataController;
                $this->gambar_apd_template = $adc->siapkanGambarTemplateBesertaPathnya($apd->image, $this->data_detail_inputan['id_jenis'], $this->data_detail_inputan['id_apd']);
            }
        }
        $this->dispatchBrowserEvent('list-ke-detail');
    }

    public function lihatPreview($value)
    {
        $this->gambar_terpilih = null;
        error_log('start preview');
        $index_inputan = $value[0];
        $index_gambar = $value[1];
        error_log($index_inputan);
        error_log($index_gambar);

        if(array_key_exists($index_inputan ,$this->list_inputan_pegawai))
        {
            error_log('array key exists');
            $gambar = $this->list_inputan_pegawai[$index_inputan]['gambar_apd'];

            if($index_gambar > -1)
                $this->gambar_terpilih = $gambar[$index_gambar];
            else
                $this->gambar_terpilih = $gambar;
        }

        $this->dispatchBrowserEvent('list-ke-preview');

    }

    public function lihatSemuaFoto($value)
    {
        $this->gambar_terpilih = null;
        if(array_key_exists($value, $this->list_inputan_pegawai))
        {
            $gambar = $this->list_inputan_pegawai[$value]['gambar_apd'];
            $this->gambar_terpilih = $gambar;
        }

        $this->dispatchBrowserEvent('list-ke-preview');

    }
}
