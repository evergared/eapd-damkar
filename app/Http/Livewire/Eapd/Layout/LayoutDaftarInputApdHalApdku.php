<?php

namespace App\Http\Livewire\Eapd\Layout;

use Illuminate\Support\Str;
use App\Http\Controllers\ApdDataController;
use Livewire\Component;
use Throwable;

class LayoutDaftarInputApdHalApdku extends Component
{

    // berisi template apd apa saja yang perlu diinput oleh user
    public $daftarApd;

    public $memuat = false,
        $listKosong = true;

    protected $listeners = [
        'LayoutDaftarInputApdHalApdku' => 'render'
    ];

    public function render()
    {
        $this->bangunDaftarInputApd();
        return view('eapd.livewire.layout.layout-daftar-input-apd-hal-apdku');
    }

    public function bangunDaftarInputApd()
    {
        try {
            $adc = new ApdDataController;
            $periode = 1;
            // $periode = $adc->ambilIdPeriodeInput();
            $this->daftarApd =  $adc->bangunListInputApdDariTemplate($periode);
        } catch (Throwable $e) {
            session()->flash('apdku_page_error', 'Kesalahan dalam pengambilan data.');
        }
    }

    public function panggilModal($id_jenis)
    {
        $this->dispatchBrowserEvent('testModal', ['id_jenis' => $id_jenis]);
    }
}
