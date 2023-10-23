<?php

namespace Database\Seeders;

use App\Models\Penempatan;
use App\Models\Wilayah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TesPenempatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data_wilayah = [
            ['id_wilayah' => '1', 'nama_wilayah' => 'Jakarta Pusat', 'keterangan' => null],
            ['id_wilayah' => '2', 'nama_wilayah' => 'Jakarta Utara', 'keterangan' => null],
            ['id_wilayah' => '3', 'nama_wilayah' => 'Jakarta Barat', 'keterangan' => null],
            ['id_wilayah' => '4', 'nama_wilayah' => 'Jakarta Selatan', 'keterangan' => null],
            ['id_wilayah' => '5', 'nama_wilayah' => 'Jakarta Timur', 'keterangan' => null],
        ];

        $data_penempatan = [
            ['id_penempatan' => 'D_1', 'nama_penempatan' => 'Kantor Dinas DKI Jakarta', 'tipe' => 'dinas'],
            ['id_penempatan' => '11', 'nama_penempatan' => 'Sudin Jakarta Pusat', 'tipe' => 'sudin', 'id_wilayah' => '1'],
            ['id_penempatan' => '1.11', 'nama_penempatan' => 'Sektor I Gambir', 'tipe' => 'sektor', 'id_wilayah' => '1'],
            ['id_penempatan' => '1.11.01', 'nama_penempatan' => 'Kantor Sektor I Gambir', 'tipe' => 'pos', 'id_wilayah' => '1'],
            ['id_penempatan' => '1.11.2', 'nama_penempatan' => 'Pos Tanah Abang', 'tipe' => 'pos', 'id_wilayah' => '1'],
            ['id_penempatan' => '1.11.3', 'nama_penempatan' => 'Pos Bendungan Hilir', 'tipe' => 'pos', 'id_wilayah' => '1'],
            ['id_penempatan' => '1.11.4', 'nama_penempatan' => 'Pos Karet', 'tipe' => 'pos', 'id_wilayah' => '1'],
            ['id_penempatan' => '1.12', 'nama_penempatan' => 'Sektor II Tanah Abang', 'tipe' => 'sektor', 'id_wilayah' => '1'],
            ['id_penempatan' => '2.11', 'nama_penempatan' => 'Sektor I Cilincing', 'tipe' => 'sektor', 'id_wilayah' => '2'],
            ['id_penempatan' => '2.12', 'nama_penempatan' => 'Sektor II Koja', 'tipe' => 'sektor', 'id_wilayah' => '2'],
            ['id_penempatan' => '3.11', 'nama_penempatan' => 'Sektor I Grogol Petamburan', 'tipe' => 'sektor', 'id_wilayah' => '3'],
            ['id_penempatan' => '3.12', 'nama_penempatan' => 'Sektor II Palmerah', 'tipe' => 'sektor', 'id_wilayah' => '3'],
            ['id_penempatan' => '41', 'nama_penempatan' => 'Sudin Jakarta Selatan', 'tipe' => 'sudin', 'id_wilayah' => '4'],
            ['id_penempatan' => '4.11', 'nama_penempatan' => 'Sektor I Kebayoran Lama', 'tipe' => 'sektor', 'id_wilayah' => '4'],
            ['id_penempatan' => '4.12', 'nama_penempatan' => 'Sektor II Kebayoran Baru', 'tipe' => 'sektor', 'id_wilayah' => '4'],
            ['id_penempatan' => '5.11', 'nama_penempatan' => 'Sektor I Matraman', 'tipe' => 'sektor', 'id_wilayah' => '5'],
            ['id_penempatan' => '5.12', 'nama_penempatan' => 'Sektor II Pulo Gadung', 'tipe' => 'sektor', 'id_wilayah' => '5'],
        ];

        foreach ($data_wilayah as $wilayah) {
            Wilayah::create($wilayah);
        }

        foreach ($data_penempatan as $penempatan) {
            Penempatan::create($penempatan);
        }
    }
}
