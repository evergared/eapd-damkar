<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Data\Apd;

use Livewire\Component;
use Throwable;

class Page extends Component
{

    protected $listeners = [
        'lihatDetail'
    ];

    public function render()
    {
        return view('livewire.dashboards.pegawai.data.apd.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'Data APD Anggota']);
    }

    public function lihatDetail($value)
    {
        try
        {
            $this->dispatchBrowserEvent('tabel-ke-detail');
        }
        catch(Throwable $e)
        {
            
        }
    }
}
