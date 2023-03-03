<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use Livewire\Component;

class LayoutProgressInputanSudinAdminSudinHalLaporanSektor extends Component
{

    public $data_semua_sektor = [];

    public function render()
    {
        return view('eapd.livewire.layout.layout-progress-inputan-sudin-admin-sudin-hal-laporan-sektor');
    }

    public function mount()
    {
        $this->muatDataInputanSudin();
    }

    public function ModalProgresSudin()
    {
        $this->dispatchBrowserEvent('ModalProgresSudin');
    }

    public function muatDataInputanSudin()
    {
        $adc = new ApdDataController;
        $this->data_semua_sektor = $adc->muatDataInputanSudin();
    }
}
