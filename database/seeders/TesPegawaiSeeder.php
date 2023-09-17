<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\Wilayah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TesPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataJabatan = Jabatan::pluck('id_jabatan')->all();
        $dataPenempatan = Penempatan::pluck('id_penempatan')->all();
        $dataGrup = [
            'A',
            'B',
            'C',
            '-'
        ];

        for ($i = 0; $i < 30; $i++) {
            Pegawai::create([
                'nrk' => Str::random(8),
                'nip' => Str::random(16),
                'nama' => fake('id_ID')->name,
                'id_jabatan' => $dataJabatan[rand(0, count($dataJabatan) - 1)],
                'id_penempatan' => $dataPenempatan[rand(0, count($dataPenempatan) - 1)],
                'grup' => $dataGrup[rand(0, count($dataGrup) - 1)],
            ]);
        }
    }
}
