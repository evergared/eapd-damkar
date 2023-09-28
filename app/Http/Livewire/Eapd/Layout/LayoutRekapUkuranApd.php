<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use App\Models\PeriodeInputApd;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

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

    public function lihatDaftarPegawai($value)
    {
        try{
            
            $ukuran = $value[0];
            $pegawai_yang_mengisi = $this->detail_jumlah_ukuran['ukuran'][$ukuran]['pegawai'];

            $this->emit('tampilTabel',[$this->detail_nama_apd,$ukuran,$pegawai_yang_mengisi]);
            $this->dispatchBrowserEvent('tampilModalDaftarPegawai');

        }
        catch(Throwable $e)
        {
            error_log('gagal dalam menampilkan modal daftar pegawai pada data ukuran '.$e);
        }
    }
}
