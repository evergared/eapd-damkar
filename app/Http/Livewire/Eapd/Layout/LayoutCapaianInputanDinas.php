<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Livewire\Component;
use Throwable;

class LayoutCapaianInputanDinas extends Component
{

    public
        $nama_periode = "-",
        $id_periode = "";
    
    public $data_capaian = [];

    public function render()
    {
        return view('eapd.livewire.layout.layout-capaian-inputan-dinas');
    }

    public function mount()
    {
        try{
            $pic = new PeriodeInputController;
            $this->id_periode = $pic->ambilIdPeriodeInput();
            $this->nama_periode = PeriodeInputApd::find($this->id_periode);
        }
        catch(Throwable $e)
        {
            error_log('gagal mengambil periode input saat memuat komponen layout-capaian-inputan-dinas '.$e);
            $periode = PeriodeInputApd::get()->first();
            $this->id_periode = $periode->id;
            $this->nama_periode = $periode->nama_periode;
        }
        
        $this->hitungCapaian();
    }   

    public function hitungCapaian()
    {
        try{

            $adc = new ApdDataController;
            $this->data_capaian = $adc->hitungCapaianInputDinas($this->id_periode);

        }
        catch(Throwable $e)
        {
            error_log('gagal menghitung capaian level dinas '.$e);
        }
    }
}
