<?php

namespace App\Http\Livewire\Eapd\Modal;

use Livewire\Component;

class ModalDetailProgressSudin extends Component
{

    public 
        $nama_pegawai = "",
        $id_pegawai = "",
        $list_inputan_pegawai = [];

    public $listeners = [
        'ModalProgressSudin'
    ];

    public function render()
    {
        return view('eapd.livewire.modal.modal-detail-progress-sudin');
    }

    public function ModalProgressSudin($value)
    {
        error_log("isi value : ".$value);
    }

}
