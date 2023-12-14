<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Livewire\Component;

class FormTabelTemplate extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.form-tabel-template');
    }

    public function tambahSatu()
    {
        $this->emit('inisiasiSatuTemplate',[false]);
    }

    public function tambahBanyak()
    {
        $this->emit('inisiasiBanyakTemplate',[false]);
    }
}
