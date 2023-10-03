<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Apdku;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.pegawai.apdku.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'APDku']);
    }

    public function mount()
    {
        
    }
}
