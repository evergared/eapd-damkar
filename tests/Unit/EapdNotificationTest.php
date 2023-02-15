<?php

namespace Tests\Unit;

use App\Models\Eapd\Mongodb\InputApd;
use App\Models\User;
use App\Notifications\PegawaiInputApd;
use App\Notifications\TesNotifikasi;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\TestCase;

class EapdNotificationTest extends TestCase
{

    // Panggil menggunakan php artisan test Tests\Unit\EapdNotificationTest.php


    public function test_kirim()
    {
        $user = User::get()->first();
        $input = new InputApd;
        $pesan = ['id_jenis'=>'123','id_pegawai'=>'321','tindakan'=>'baru'];
        // Notification::send($input,new PegawaiInputApd('test'));
        $user->notify(new TesNotifikasi());
        $this->assertTrue(true);
    }
}
