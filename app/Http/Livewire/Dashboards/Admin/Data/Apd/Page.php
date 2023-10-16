<?php

namespace App\Http\Livewire\Dashboards\Admin\Data\Apd;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.data.apd.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Halaman Data APD"]);
    }
}
