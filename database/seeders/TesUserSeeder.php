<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_pegawai = Pegawai::all();

        foreach($data_pegawai as $pegawai)
        {
            User::create([
                'id_pegawai' => $pegawai->id_pegawai,
                'password' => Hash::make('123456')
            ]);
        }
    }
}
