<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class PegawaiQuickFix extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_pegawai_baru = [
            ['nama' => 'Muhammad Reza Fahrezi', 'id_penempatan' => '5.16', 'nip' => null, 'nrk' => '80734049', 'id_jabatan' => 'PJLPK'],
        ];

        foreach($data_pegawai_baru as $d)
        {
            $p = Pegawai::create($d);
            User::create(
                [
                    'id_pegawai' => $p->id_pegawai,
                    'password' => Hash::make('123456')
                ]
                );
        }

        // ganti data pegawai baru sesuai kebutuhan
        // lalu jalankan perintah : 
        // php artisan db:seed --class=PegawaiQuickFix
        // copas dari db locale apa yang dibuat ke db server 
        
    }
}
