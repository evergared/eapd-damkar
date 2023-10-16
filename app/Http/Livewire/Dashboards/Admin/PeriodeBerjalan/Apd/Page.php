<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.periode-berjalan.apd.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Inputan APD Saat ini"]);
    }
}
