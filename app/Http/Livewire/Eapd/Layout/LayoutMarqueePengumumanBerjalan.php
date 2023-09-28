<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\PeriodeInputController;
use App\Models\PeriodeInputApd;
use Livewire\Component;

class LayoutMarqueePengumumanBerjalan extends Component
{

    public bool
        $aktif = false,
        $mode_tes = false;

    public 
        $data_yang_ditampilkan = [],
        $data_tes_yang_ditampilkan = "";

    protected $listeners = [
        'TerimaPesanTes' => 'setPesanTes'
    ];

    #region Livewire function
    public function render()
    {
        return view('eapd.livewire.layout.layout-marquee-pengumuman-berjalan');
    }

    public function mount()
    {
        $pic = new PeriodeInputController;
        if($periode = PeriodeInputApd::find($pic->ambilIdPeriodeInput()))
            array_push($this->data_yang_ditampilkan,$periode->pesan_berjalan);
    }
    #endregion

    public function setPesanTes($value)
    {
        $this->data_tes_yang_ditampilkan = $value;
        $this->aktif = true;
        $this->mode_tes = true;
    }   
}
