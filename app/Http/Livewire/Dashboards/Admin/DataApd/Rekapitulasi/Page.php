<?php

namespace App\Http\Livewire\Dashboards\Admin\DataApd\Rekapitulasi;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.data-apd.rekapitulasi.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Rekap APD"]);
    }
}
