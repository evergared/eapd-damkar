<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Progress\Ukuran;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.pegawai.progress.ukuran.page')->layout('livewire.layouts.adminlte-dashboard',['page_title' => 'Progress Input Ukuran Anggota']);
    }
}
