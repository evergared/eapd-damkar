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

        // for ($i = 0; $i < 30; $i++) {
        //     Pegawai::create([
        //         'nrk' => Str::random(8),
        //         'nip' => Str::random(16),
        //         'nama' => fake('id_ID')->name,
        //         'id_jabatan' => $dataJabatan[rand(0, count($dataJabatan) - 1)],
        //         'id_penempatan' => $dataPenempatan[rand(0, count($dataPenempatan) - 1)],
        //         'grup' => $dataGrup[rand(0, count($dataGrup) - 1)],
        //     ]);
        // }

        // $kasek_1 = Pegawai::create([
        //     'nrk' => '0111',
        //     'nip' => '31740111',
        //     'nama' => 'Kasek 1.11',
        //     'id_jabatan' => 'K001',
        //     'id_penempatan' => '1.11',
        //     'grup' => '-',
        // ])->id_pegawai;

        // $pengendali_1 = Pegawai::create([
        //     'nrk' => '0011',
        //     'nip' => '31740011',
        //     'nama' => 'Pengendali 1.11 grup A',
        //     'id_jabatan' => 'L002',
        //     'id_penempatan' => '1.11',
        //     'penanggung_jawab' => $kasek_1,
        //     'grup' => 'A',
        // ])->id_pegawai;

        // Pegawai::create([
        //     'nrk' => '0001',
        //     'nip' => '31740001',
        //     'nama' => 'Anggota Asn sektor 1.11 A 1',
        //     'id_jabatan' => 'L001',
        //     'id_penempatan' => '1.11',
        //     'penanggung_jawab' => $pengendali_1,
        //     'grup' => 'A',
        // ]);

        // Pegawai::create([
        //     'nrk' => '0002',
        //     'nip' => '31740002',
        //     'nama' => 'Anggota Asn sektor 1.11 A 2',
        //     'id_jabatan' => 'L001',
        //     'id_penempatan' => '1.11',
        //     'penanggung_jawab' => $pengendali_1,
        //     'grup' => 'A',
        // ]);
    }
}
