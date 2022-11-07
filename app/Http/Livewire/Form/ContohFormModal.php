<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class ContohFormModal extends Component
{
    public $test;

    protected $listeners = ['ubahTest'];

    public function render()
    {
        return view('livewire.contoh-form-modal');
    }

    public function ubahTest($pesan = "-")
    {
        $this->test =  $pesan;
    }
}
