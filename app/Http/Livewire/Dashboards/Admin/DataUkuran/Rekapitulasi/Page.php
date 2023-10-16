<?php

namespace App\Http\Livewire\Dashboards\Admin\DataUkuran\Rekapitulasi;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.data-ukuran.rekapitulasi.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Rekap Ukuran"]);
    }
}
