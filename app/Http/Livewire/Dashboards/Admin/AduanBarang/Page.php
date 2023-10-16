<?php

namespace App\Http\Livewire\Dashboards\Admin\AduanBarang;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.aduan-barang.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Aduan Barang Admin"]);
    }
}
