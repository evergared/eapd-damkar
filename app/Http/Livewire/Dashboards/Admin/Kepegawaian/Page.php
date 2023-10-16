<?php

namespace App\Http\Livewire\Dashboards\Admin\Kepegawaian;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.kepegawaian.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Halaman Kepegawaian Admin"]);
    }
}
