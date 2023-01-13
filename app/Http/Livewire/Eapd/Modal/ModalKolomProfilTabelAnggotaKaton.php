<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Models\Eapd\Pegawai;
use Livewire\Component;

class ModalKolomProfilTabelAnggotaKaton extends Component
{

    public  $nrk,
        $nip,
        $img,
        $nama,
        $pos;

    protected $listeners = [

        'tampilProfil'

    ];

    public function render()
    {
        return view('eapd.livewire.modal.modal-kolom-profil-tabel-anggota-katon');
    }

    public function tampilProfil($value)
    {

        $pegawai = Pegawai::where('id', '=', $value)->first();

        $this->nrk = $pegawai->nrk;
        $this->nip = $pegawai->nip;
        $this->nama = $pegawai->nama;
        $this->img = $pegawai->profile_img;
        $this->pos = $pegawai->penempatan->nama_penempatan;
    }
}
