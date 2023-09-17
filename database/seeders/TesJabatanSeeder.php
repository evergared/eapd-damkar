<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TesJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_jabatan = [
            ['id_jabatan' => 'pjlp', 'nama_jabatan' => 'PJLP Damkar'],
            ['id_jabatan' => 'L001', 'nama_jabatan' => 'Anggota'],
            ['id_jabatan' => 'L002', 'nama_jabatan' => 'Pengendali'],
            ['id_jabatan' => 'K001', 'nama_jabatan' => 'Kepala Sektor'],
            ['id_jabatan' => 'K002', 'nama_jabatan' => 'Kasie Dalkarmat'],
            ['id_jabatan' => 'K003', 'nama_jabatan' => 'Kasie Sarana'],
            ['id_jabatan' => 'K004', 'nama_jabatan' => 'Kepala Sudin'],
            ['id_jabatan' => 'K005', 'nama_jabatan' => 'Kepala Bidang Sarpras'],
            ['id_jabatan' => 'S001', 'nama_jabatan' => 'Staff Sektor'],
            ['id_jabatan' => 'S002', 'nama_jabatan' => 'Staff Tata Usaha'],

        ];

        foreach($data_jabatan as $jabatan)
        {
            Jabatan::create($jabatan);
        }
    }
}
