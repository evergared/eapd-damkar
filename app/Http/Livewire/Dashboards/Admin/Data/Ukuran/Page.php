<?php

namespace App\Http\Livewire\Dashboards\Admin\Data\Ukuran;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.data.ukuran.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Halaman Data Ukuran"]);
    }
}
