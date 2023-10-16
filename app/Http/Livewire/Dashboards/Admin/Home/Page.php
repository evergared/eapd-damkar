<?php

namespace App\Http\Livewire\Dashboards\Admin\Home;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.home.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Halaman Admin"]);
    }
}
