<?php

namespace App\Http\Livewire\Dashboards\Admin\Profil;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.profil.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Profil Admin"]);
    }
}
