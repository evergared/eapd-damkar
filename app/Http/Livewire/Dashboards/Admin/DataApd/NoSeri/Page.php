<?php

namespace App\Http\Livewire\Dashboards\Admin\DataApd\NoSeri;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.data-apd.no-seri.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Pengaturan Nomer Seri"]);
    }
}
