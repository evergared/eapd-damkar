<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\JenisBarang;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-barang.jenis-barang.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Pengaturan Jenis Barang"]);
    }
}
