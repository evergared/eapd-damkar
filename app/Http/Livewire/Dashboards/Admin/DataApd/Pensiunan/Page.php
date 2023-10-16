<?php

namespace App\Http\Livewire\Dashboards\Admin\DataApd\Pensiunan;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.data-apd.pensiunan.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Inputan APD Pensiunan"]);
    }
}
