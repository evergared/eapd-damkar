<?php

namespace Database\Seeders;

use App\Models\InputApdTemplate;
use App\Models\Jabatan;
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
            ['id_jenis' => 'A001', 'opsi_apd' => ['A001_Sun_0001']],
            ['id_jenis' => 'A002', 'opsi_apd' => ['A002_Uve_0001']],
            ['id_jenis' => 'A003', 'opsi_apd' => ['A003_Sta_0001']],
            ['id_jenis' => 'A004', 'opsi_apd' => ['A004_Pel_0001']],
            ['id_jenis' => 'A005', 'opsi_apd' => ['A005_Nom_0001']],
            ['id_jenis' => 'A006', 'opsi_apd' => ['A006_Pem_0001']],
            ['id_jenis' => 'A007', 'opsi_apd' => ['A007_Pem_0001']],
            ['id_jenis' => 'A008', 'opsi_apd' => ['A008_Pem_0001']],
            ['id_jenis' => 'B001', 'opsi_apd' => ['B001_Har_0001']],
            ['id_jenis' => 'B002', 'opsi_apd' => ['B002_Com_0001']],
            ['id_jenis' => 'B003', 'opsi_apd' => ['B003_Her_0001']],
            ['id_jenis' => 'G001', 'opsi_apd' => ['G001_Car_0001']],
            ['id_jenis' => 'G002', 'opsi_apd' => ['G002_Zhi_0001']],
            ['id_jenis' => 'H001', 'opsi_apd' => ['H001_Cal_0001']],
            ['id_jenis' => 'H002', 'opsi_apd' => ['H002_Dra_0001']],
            ['id_jenis' => 'T001', 'opsi_apd' => ['T001_Pem_0001']],
            ['id_jenis' => 'T002', 'opsi_apd' => ['T002_Pem_0001']],
        ];

        $jabatan = Jabatan::all();

        foreach ($jabatan as $j)
            InputApdTemplate::create([
                "id_jabatan" => $j->id_jabatan,
                "id_periode" => '1',
                "nama" => "test template input anggota 2023",
                "template" => $template_anggota
            ]);
    }
}
