<?php

namespace App\Http\Livewire\Dashboards\Pegawai\BantuanBarang\GantiBarang;

use Livewire\Component;

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.pegawai.bantuan-barang.ganti-barang.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'Permohonan Ganti Barang APD']);
    }
}
