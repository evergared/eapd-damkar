<?php

namespace App\Http\Livewire\Tes\Form;

use Livewire\Component;
use App\Models\Tes\TesMultiUpload as Tes;

class TesFormMultiUpload extends Component
{
    public $ida, $nama;
    public  $foto = [],
        $uploadedFoto;

    public $listeners = [
        'edit-profil' => 'editProfil'
    ];

    public function render()
    {
        return view('tes.livewire.form.tes-form-multi-upload');
    }

    public function editProfil($ida)
    {
        $item = Tes::find($ida);

        $this->ida = $item->id;
        $this->nama = $item->nama;
        $this->uploadedFoto = $item->foto;
    }
}
