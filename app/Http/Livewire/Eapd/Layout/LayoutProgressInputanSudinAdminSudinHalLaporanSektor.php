<?php

namespace App\Http\Livewire\Eapd\Layout;

use Livewire\Component;

class LayoutProgressInputanSudinAdminSudinHalLaporanSektor extends Component
{
    public function render()
    {
        return view('eapd.livewire.layout.layout-progress-inputan-sudin-admin-sudin-hal-laporan-sektor');
    }

    public function mount()
    {
        // $penempatan = 
    }

    public function ModalProgresSudin()
    {
        $this->dispatchBrowserEvent('ModalProgresSudin');
    }
}
