<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Ukuran;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.periode-berjalan.ukuran.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Inputan Ukuran Saat Ini"]);
    }
}
