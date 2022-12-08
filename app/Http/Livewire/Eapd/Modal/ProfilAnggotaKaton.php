<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Models\Eapd\Pegawai;
use Livewire\Component;

class ProfilAnggotaKaton extends Component
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
        return view('eapd.livewire.modal.profil-anggota-katon');
    }

    public function tampilProfil($value)
    {
        // error_log('value ; ' . $value);
        $this->nrk = $value;

        $pegawai = Pegawai::where('nrk', '=', $value)->first();

        $this->nip = $pegawai->nip;
        $this->nama = $pegawai->nama;
        $this->img = $pegawai->profile_img;
        $this->pos = $pegawai->penempatan->nama_penempatan;
    }
}
