<?php

namespace App\Http\Livewire\Tes\Komponen;

use Livewire\Component;

class ContohFormModal extends Component
{
    public $test;

    protected $listeners = ['ubahTest'];

    public function render()
    {
        return view('tes.livewire.komponen.contoh-form-modal');
    }

    public function ubahTest($pesan = "-")
    {
        $this->test =  $pesan;
    }
}
