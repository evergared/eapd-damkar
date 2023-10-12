<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Data\Ukuran;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.pegawai.data.ukuran.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'Data Ukuran Anggota']);
    }
}
