<?php

namespace Database\Seeders;

use App\Models\ApdJenis;
use App\Models\ApdKondisi;
use App\Models\ApdSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TesJenisApdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * H - Helmet
         * T - Tubuh/Trouser
         * G - Gloves
         * B - Boots
         * A - Additionals
         */
        $dataJenisItem = [
            ['id_jenis' => 'H001', 'nama_jenis' => 'Fire Helmet', 'keterangan' => null],
            ['id_jenis' => 'H002', 'nama_jenis' => 'Rescue Helmet', 'keterangan' => null],
            ['id_jenis' => 'T001', 'nama_jenis' => 'Fire Jacket', 'keterangan' => null],
            ['id_jenis' => 'T002', 'nama_jenis' => 'Jumpsuit', 'keterangan' => null],
            ['id_jenis' => 'G001', 'nama_jenis' => 'Fire Gloves', 'keterangan' => null],
            ['id_jenis' => 'G002', 'nama_jenis' => 'Rescue Gloves', 'keterangan' => null],
            ['id_jenis' => 'B001', 'nama_jenis' => 'Fire Boots', 'keterangan' => null],
            ['id_jenis' => 'B002', 'nama_jenis' => 'Rescue Boots', 'keterangan' => null],
            ['id_jenis' => 'A001', 'nama_jenis' => 'Respirator', 'keterangan' => null],
            ['id_jenis' => 'A002', 'nama_jenis' => 'Fire Goggles', 'keterangan' => null],
            ['id_jenis' => 'A003', 'nama_jenis' => 'Kapak', 'keterangan' => null],
            ['id_jenis' => 'A004', 'nama_jenis' => 'Senter', 'keterangan' => null],
        ];

        $kondisiUmum = [
            ['text' => 'Baik, Dapat digunakan dengan baik', 'value' => 'baik'],
            ['text' => 'Rusak ringan seperti, sobek kecil atau warna sedikit pudar', 'value' => 'rusak ringan'],
            ['text' => 'Rusak sedang namun dapat digunakan dengan baik', 'value' => 'rusak sedang'],
            ['text' => 'Rusak berat, apd sudah tidak dapat digunakan', 'value' => 'rusak berat'],
        ];



        $kondisiHelmUmum = [
            ['text' => 'Baik', 'value' => 'baik'],
            ['text' => 'Rusak ringan, tali helm putus', 'value' => 'rusak ringan'],
            ['text' => 'Rusak sedang, helm masih dapat dipakai', 'value' => 'rusak sedang'],
            ['text' => 'Rusak berat, helm tidak dapat dipakai', 'value' => 'rusak berat'],
        ];

        $sizeUmum = array(
            'XL',
            'L',
            'M',
            'S'
        );

        $sizeSepatu = array(
            '38',
            '39',
            '40',
            '41',
            '42',
            '43',
            '44',
            '45',
        );

        ApdKondisi::create([
            "nama_kondisi" => "Kondisi Umum",
            "opsi" => $kondisiUmum
        ]);

        ApdKondisi::create([
            "nama_kondisi" => "Kondisi Helm Umum",
            "opsi" => $kondisiHelmUmum
        ]);

        ApdSize::create([
            "nama_size" => "Ukuran Standar",
            "opsi" => $sizeUmum
        ]);

        ApdSize::create([
            "nama_size" => "Ukuran Standar Sepatu",
            "opsi" => $sizeSepatu
        ]);

        foreach ($dataJenisItem as $data)
        {
            ApdJenis::create([
                "id_jenis" => $data['id_jenis'],
                "nama_jenis" => $data['nama_jenis']
            ]);
        }
    }
}
