<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Home;

use Livewire\Component;

class Page extends Component
{

    public function render()
    {
        return view('livewire.dashboards.pegawai.home.page')->layout('livewire.layouts.adminlte-dashboard',['page_title' => 'Dashboard Pegawai']);
    }
}
