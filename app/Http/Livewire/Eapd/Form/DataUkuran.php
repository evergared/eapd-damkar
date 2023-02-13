<?php

namespace App\Http\Livewire\Eapd\Form;

use App\Enum\StatusApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdRekapController;
use App\Models\Eapd\InputApd;
use Livewire\Component;
use Throwable;

class DataUkuran extends Component
{
    public
        $data_rekap_apd,
        $detail_data_rekap;

    public
        $id_periode,
        $nama_periode = "Triwulan ke-4 2023";

    protected $listeners = [
        'rekapDetail'
    ];

    public function render()
    {

        $apr = new ApdRekapController;
        $adc = new ApdDataController;
        // $this->id_periode = $adc->ambilIdPeriodeInput();
        // $this->nama_periode = PeriodeInputApd::where('id','=',$periode)->first()->nama_periode;
        $this->id_periode = 1;
        $this->data_rekap_apd = $apr->bangunDataTabelRekapApdSektor($this->id_periode);
        return view('eapd.livewire.form.data-ukuran');
    }

    public function rekapDetail($value)
    {
        $this->detail_data_rekap = [];
        try {
            $apr = new ApdRekapController;
            $id_jenis = $value[0];
            if ($value[1] == "total")
                $kondisi = "";
            else
                $kondisi = StatusApd::tryFrom($value[1]);

            if ($kondisi != "") {
                $this->detail_data_rekap = $apr->bangunListDetailRekapApdSektor($id_jenis, $this->id_periode, "", $kondisi);
            } else {
                $this->detail_data_rekap = $apr->bangunListDetailRekapApdSektor($id_jenis, $this->id_periode);
            }
        } catch (Throwable $e) {
            error_log('gagal membuat list detail rekap ' . $e);
            unset($this->detail_data_rekap);
        }
    }
    public $gambar = "";
}
