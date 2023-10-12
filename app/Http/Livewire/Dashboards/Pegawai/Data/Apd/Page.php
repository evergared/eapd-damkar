<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Data\Apd;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.pegawai.data.apd.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'Data APD Anggota']);
    }
}
