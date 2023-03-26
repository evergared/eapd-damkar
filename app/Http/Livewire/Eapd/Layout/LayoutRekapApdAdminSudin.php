<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdRekapController;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Livewire\Component;
use Throwable;

class LayoutRekapApdAdminSudin extends Component
{
    public
        $id_periode = "",
        $nama_periode = "",
        $data_rekap_apd = [];

    public function render()
    {
        return view('eapd.livewire.layout.layout-rekap-apd-admin-sudin');
    }

    public function mount()
    {
        try{
            $adc = new ApdDataController;
            $this->id_periode = $adc->ambilIdPeriodeInput();
            $this->nama_periode = PeriodeInputApd::find($this->id_periode)->nama_periode;
            $this->muatDataRekap();
        }
        catch(Throwable $e)
        {
            error_log("gagal memuat ".$e);
        }
    }

    public function detailRekap($value)
    {
        try{
            error_log($value[0]);
            $this->dispatchBrowserEvent('showDetailRekapApdAdminSudin');

        }
        catch(Throwable $e)
        {

        }
    }

    public function muatDataRekap()
    {
        try{

            $apr = new ApdRekapController;
            $this->data_rekap_apd = $apr->bangunDataTabelRekapApdSudin();
        }
        catch(Throwable $e)
        {
            error_log('gagal memuat data rekap () '.$e);
        }
    }
}
