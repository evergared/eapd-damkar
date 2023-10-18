<?php

namespace Database\Seeders;

use App\Models\InputApdTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TesTemplateApdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template_anggota = [
            ['id_jenis' => 'H002', 'opsi_apd' => ['H-fir-0001']],
            ['id_jenis' => 'H001', 'opsi_apd' => ['H-bro-0000']],
            ['id_jenis' => 'G001', 'opsi_apd' => ['G-glo-0000']],
            ['id_jenis' => 'G002', 'opsi_apd' => ['G-alt-0001']],
            ['id_jenis' => 'T001', 'opsi_apd' => ['T-fir-0000']],
            ['id_jenis' => 'T002', 'opsi_apd' => ['T-yoh-0000']],
            ['id_jenis' => 'B001', 'opsi_apd' => ['B-yoh-0000']],
            ['id_jenis' => 'B002', 'opsi_apd' => ['B-ari-0001']],
            ['id_jenis' => 'A001', 'opsi_apd' => ['A-dar-0000']],
            ['id_jenis' => 'A002', 'opsi_apd' => ['A-ari-0000']],
            ['id_jenis' => 'A003', 'opsi_apd' => ['A-tho-0000']],
            ['id_jenis' => 'A004', 'opsi_apd' => ['A-uni-0000']]
        ];

        InputApdTemplate::create([
            "id_jabatan" => 'VK001',
            "id_periode" => '1',
            "id_template" => 'test',
            "nama" => "test template input anggota 2023",
            "template" => $template_anggota
        ]);
    }
}
