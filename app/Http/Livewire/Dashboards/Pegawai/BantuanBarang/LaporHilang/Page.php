<?php

namespace App\Http\Livewire\Dashboards\Pegawai\BantuanBarang\LaporHilang;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.pegawai.bantuan-barang.lapor-hilang.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'Lapor Kehilangan APD']);
    }
}
