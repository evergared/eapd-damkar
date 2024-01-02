<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Livewire\Component;

class FormTabelTemplate extends Component
{

    public $id_periode = null;

    protected $listeners = [
        'inisiasiTabelTemplate' => 'inisiasi'
    ];


    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.form-tabel-template');
    }

    public function inisiasi($val)
    {
        $this->id_periode = $val;
    }

    public function tambahSatu()
    {
        $this->emit('inisiasiSatuTemplate',$this->id_periode);
    }

    public function tambahBanyak()
    {
        $this->emit('inisiasiBanyakTemplate',$this->id_periode);
    }
}
