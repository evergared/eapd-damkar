<?php

namespace App\Http\Livewire\Layouts\Navigasi;

use Livewire\Component;

class AdminltePegawaiTopnav extends Component
{
    public $server_time = null;

    public function render()
    {
        $this->server_time = now()->milliseconds;
        return view('livewire.layouts.navigasi.adminlte-pegawai-topnav');
    }
}
