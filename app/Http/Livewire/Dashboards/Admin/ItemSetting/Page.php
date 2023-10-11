<?php

namespace App\Http\Livewire\Dashboards\Admin\ItemSetting;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.item-setting.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Halaman Item Setting Admin"]);
    }
}
