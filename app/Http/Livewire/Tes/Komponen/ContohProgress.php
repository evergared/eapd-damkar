<?php

namespace App\Http\Livewire\Tes\Komponen;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Events\ContohEvent;
use Illuminate\Support\Facades\Auth;

class ContohProgress extends Component
{

    public $email, $telpon, $profil, $emailPersen, $telponPersen, $profilPersen, $totalRow, $message;
    public $nrkPenggunaSekarang;


    protected $listeners = [
        "echo:tes,ContohEvent" => 'writeMessage'
    ];

    // public function getListeners()
    // {
    //     return [
    //         "private-echo:tes.{$this->nrkPenggunaSekarang},ContohEvent" => 'writeMessage'
    //     ];
    // }

    public function render()
    {
        return view('tes.livewire.komponen.contoh-progress');
    }

    public function update()
    {
        $this->totalRow = DB::table('pegawai')->count();

        $this->emailPersen = number_format((DB::table('pegawai')->whereNot('email', '=', '')->whereNotNull('email')->count() / $this->totalRow) * 100, 3);
        $this->profilPersen = number_format((DB::table('pegawai')->whereNot('profile_img', '=', '')->whereNotNull('profile_img')->count() / $this->totalRow) * 100, 3);
        $this->telponPersen = number_format((DB::table('pegawai')->whereNot('no_telp', '=', '')->whereNotNull('no_telp')->count() / $this->totalRow) * 100, 3);

        $this->email = DB::table('pegawai')->whereNot('email', '=', '')->whereNotNull('email')->count();
        $this->profil = DB::table('pegawai')->whereNot('profile_img', '=', '')->whereNotNull('profile_img')->count();
        $this->telpon = DB::table('pegawai')->whereNot('no_telp', '=', '')->whereNotNull('no_telp')->count();
    }

    public function writeMessage($event)
    {
        error_log('Livewire listened to event broadcast! ' . $event['nrk']);
        $this->update();
        $this->message = "Update Pegawai Telah berhasil dilakukan!";
    }
}
