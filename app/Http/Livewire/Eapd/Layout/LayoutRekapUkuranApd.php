<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LayoutRekapUkuranApd extends Component
{

    public
        $nama_periode = "", 
        $data_ukuran = [];
    
    public
        $detail_nama_apd = "",
        $detail_jumlah_ukuran =[];

    public function render()
    {
        return view('eapd.livewire.layout.layout-rekap-ukuran-apd');
    }

    public function mount()
    {
        $this->Inisiasi();
    }

    public function Inisiasi()
    {
        $this->data_ukuran = [];

        $adc = new ApdDataController;
        $this->nama_periode = PeriodeInputApd::find($adc->ambilIdPeriodeInput())->nama_periode;
        $this->data_ukuran = $adc->muatDataUkuranApd(Auth::user()->data->id_penempatan);
    }

    public function lihatJumlahUkuran($value)
    {
        $this->detail_nama_apd = $value;
        $this->detail_jumlah_ukuran = $this->data_ukuran['list_apd'][$this->detail_nama_apd];
        // dd($this->detail_jumlah_ukuran);
        $this->dispatchBrowserEvent('tampilJumlahUkuranApd');
    }
}
