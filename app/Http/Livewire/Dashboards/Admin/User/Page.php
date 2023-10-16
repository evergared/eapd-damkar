<?php

namespace App\Http\Livewire\Dashboards\Admin\User;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.user.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Pengaturan Akun User Pegawai"]);
    }
}
