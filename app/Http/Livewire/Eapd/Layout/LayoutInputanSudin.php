<?php

namespace App\Http\Livewire\Eapd\Layout;

use Livewire\Component;

class LayoutInputanSudin extends Component
{
    public function render()
    {
        return view('eapd.livewire.layout.layout-inputan-sudin');
    }

    public function ModalProgresSudin()
    {
        $this->dispatchBrowserEvent('ModalProgresSudin');
    }
}
