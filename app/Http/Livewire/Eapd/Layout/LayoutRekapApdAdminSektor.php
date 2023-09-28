<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Enum\StatusApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdRekapController;
use App\Models\InputApd;
use App\Models\PeriodeInputApd;
use Livewire\Component;
use Throwable;

class LayoutRekapApdAdminSektor extends Component
{
    public 
        $data_rekap_apd,
        $detail_data_rekap;

    public
        $id_periode, 
        $nama_periode = "Triwulan ke-4 2023";

    protected $listeners = [
        'rekapProgres'
    ];

    public function render()
    {

        
        return view('eapd.livewire.layout.layout-rekap-apd-admin-sektor');
    }

    public function mount()
    {
        $apr = new ApdRekapController;
        $adc = new ApdDataController;
        $periode = $adc->ambilIdPeriodeInput();
        $this->nama_periode = PeriodeInputApd::where('id_periode','=',$periode)->first()->nama_periode;
        $this->id_periode = $periode;
        $this->data_rekap_apd = $apr->bangunDataTabelRekapApdSektor($this->id_periode);
    }

    public function rekapProgres($value)
    {
        $this->detail_data_rekap = [];
        try{
            $apr = new ApdRekapController;
            $id_jenis = $value[0];
            error_log('id jenis untuk detail : '.$value[0]);
            error_log('target untuk detail : '.$value[1]);
            if($value[1] == "total" || $value[1] == "distribusi")
                $kondisi = "";
            else
                $kondisi = StatusApd::tryFrom($value[1]);
            
            if($kondisi != "")
            {
                $this->detail_data_rekap = $apr->bangunListDetailRekapApdSektor($id_jenis,$this->id_periode,"",$kondisi);
            }
            else
            {
                $this->detail_data_rekap = $apr->bangunListDetailRekapApdSektor($id_jenis,$this->id_periode);
            }


        }
        catch(Throwable $e)
        {
            error_log('gagal membuat list detail rekap '.$e);
            unset($this->detail_data_rekap);
        }
    }

}
