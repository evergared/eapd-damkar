<?php

namespace App\Http\Livewire\Dashboards\Admin\DataApd\Inputan;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.data-apd.inputan.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Admin Inputan Pegawai"]);
    }
}
