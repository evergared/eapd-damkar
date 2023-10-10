<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Progress\Apd;

use Livewire\Component;

class Page extends Component
{

    public 
        $value_inputan_semua_anggota = 0,
        $max_inputan_semua_anggota = 0,
        $value_tervalidasi_semua_anggota = 0;

    public function render()
    {
        return view('livewire.dashboards.pegawai.progress.apd.page')->layout('livewire.layouts.adminlte-dashboard',['page_title' => 'Progress Input APD Anggota']);
    }

    public function kalkulasiCapaian()
    {
        
    }
}
