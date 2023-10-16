<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-barang.apd.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Pengaturan Barang APD"]);
    }
}
