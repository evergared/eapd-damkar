<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ContohProgress extends Component
{

    public $email, $telpon, $profil, $emailPersen, $telponPersen, $profilPersen, $totalRow, $message;


    public $listener = [
        'pegawaiUpdated' => 'update',
        'echo:tes,InputDilakukan' => 'writeMessage'
    ];

    public function render()
    {
        return view('livewire.contoh-progress');
    }

    public function update()
    {
        $this->totalRow = DB::table('pegawai')->count();

        $this->emailPersen = number_format((DB::table('pegawai')->whereNot('email', '=', '')->whereNotNull('email')->count() / $this->totalRow) * 100, 3);
        $this->profilPersen = number_format((DB::table('pegawai')->whereNot('foto', '=', '')->whereNotNull('foto')->count() / $this->totalRow) * 100, 3);
        $this->telponPersen = number_format((DB::table('pegawai')->whereNot('telpon', '=', '')->whereNotNull('telpon')->count() / $this->totalRow) * 100, 3);

        $this->email = DB::table('pegawai')->whereNot('email', '=', '')->whereNotNull('email')->count();
        $this->profil = DB::table('pegawai')->whereNot('foto', '=', '')->whereNotNull('foto')->count();
        $this->telpon = DB::table('pegawai')->whereNot('telpon', '=', '')->whereNotNull('telpon')->count();
    }

    public function writeMessage()
    {
        $this->message = "Update Pegawai Telah berhasil dilakukan!";
    }
}
