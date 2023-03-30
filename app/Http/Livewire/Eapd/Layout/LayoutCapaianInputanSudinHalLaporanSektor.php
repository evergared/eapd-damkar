<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class LayoutCapaianInputanSudinHalLaporanSektor extends Component
{

    public 
        $maks_inputan = 200,
        $value_inputan = 0,
        $maks_tervalidasi = 200,
        $value_tervalidasi = 0;

    public function render()
    {
        return view('eapd.livewire.layout.layout-capaian-inputan-sudin-hal-laporan-sektor');
    }

    public function mount()
    {
        $this->hitungCapaian();
    }

    public function hitungCapaian()
    {
        try{

            $sudin = Auth::user()->data->penempatan->id_wilayah;

            $adc = new ApdDataController;
            $adc->hitungCapaianInputSudin($sudin,$this->maks_inputan,$this->value_inputan);
            $adc->hitungCapaianInputSudin($sudin,$this->maks_tervalidasi,$this->value_tervalidasi,1,3);

        }
        catch(Throwable $e)
        {
            $this->maks_inputan = 200;
            $this->value_inputan = 0;
            $this->maks_tervalidasi = 200;
            $this->value_tervalidasi = 0;
            error_log('gagal menghitung capaian inputan sudin : '.$e);
        }
    }
}
