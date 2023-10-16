<?php

namespace App\Http\Livewire\Dashboards\Admin\DataUkuran\ListUkuran;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.data-ukuran.list-ukuran.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "List Ukuran Terinput"]);
    }
}
