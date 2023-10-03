<?php

namespace Database\Seeders;

use App\Models\ApdList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TesBarangApdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dataContohApd = [
            ['id_apd' => 'H-bro-0000', 'nama_apd' => 'Protect Red', 'merk' => 'Bronson', 'id_jenis' => 'H001', 'id_size' => null, 'id_kondisi' => "2", 'image' => 'fire-helmet-2021.png'],
            ['id_apd' => 'H-bro-0001', 'nama_apd' => 'Alpha Head', 'merk' => 'Bronson', 'id_jenis' => 'H001', 'id_size' => null, 'id_kondisi' => "2", 'image' => 'firehelmet_4.jpg||firehelmet_5.jpg'],
            ['id_apd' => 'H-fir-0000', 'nama_apd' => 'Helmet Fire', 'merk' => 'Fire Protect', 'id_jenis' => 'H001', 'id_size' => null, 'id_kondisi' => "2", 'image' => 'firehelmet_6.jpg'],

            ['id_apd' => 'H-fir-0001', 'nama_apd' => 'Red Helmet', 'merk' => 'Fire Protect', 'id_jenis' => 'H002', 'id_size' => null, 'id_kondisi' => "2", 'image' => 'rescue-helmet-2021.png'],

            ['id_apd' => 'G-glo-0000', 'nama_apd' => 'Red Hand', 'merk' => 'Gloves Maker', 'id_jenis' => 'G001', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'fire-glove-2022.png'],
            ['id_apd' => 'G-glo-0001', 'nama_apd' => 'Yellow Hand', 'merk' => 'Gloves Maker', 'id_jenis' => 'G001', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'firegloves_2.jpg'],
            ['id_apd' => 'G-alt-0000', 'nama_apd' => 'Safety Gloves', 'merk' => 'Altair Industries', 'id_jenis' => 'G001', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'firegloves_1.jpg||firegloves_2.jpg'],

            ['id_apd' => 'G-alt-0001', 'nama_apd' => 'Rescue Gloves', 'merk' => 'Altair Industries', 'id_jenis' => 'G002', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'rescue-glove-2022.png'],
            ['id_apd' => 'G-alt-0002', 'nama_apd' => 'Slightly More Safety Gloves', 'merk' => 'Altair Industries', 'id_jenis' => 'G002', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'rescuegloves_2.jpg'],


            ['id_apd' => 'T-fir-0000', 'nama_apd' => 'Fire Jacket', 'merk' => 'Fire Protect', 'id_jenis' => 'T001', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'fire-jacket-2021.png||fire-jacket-back-2021.png'],
            ['id_apd' => 'T-pol-0000', 'nama_apd' => 'Fire Suit', 'merk' => 'Poland Inc', 'id_jenis' => 'T001', 'id_size' => '1', 'id_kondisi' => '1', 'image' => null],

            ['id_apd' => 'T-pol-0001', 'nama_apd' => 'Jump Suit Poland', 'merk' => 'Poland Inc', 'id_jenis' => 'T002', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'jumsuit-2022.jpg'],
            ['id_apd' => 'T-yoh-0000', 'nama_apd' => 'Jump Suit', 'merk' => 'Yohanes Safety Accredited', 'id_jenis' => 'T002', 'id_size' => '1', 'id_kondisi' => '1', 'image' => null],

            ['id_apd' => 'B-yoh-0000', 'nama_apd' => 'Fire Hazard Boots', 'merk' => 'Yohanes Safety Accredited', 'id_jenis' => 'B001', 'id_size' => "2", 'id_kondisi' => '1', 'image' => 'fire-boots-2022.png'],
            ['id_apd' => 'B-ari-0000', 'nama_apd' => 'Fire Safety Boots', 'merk' => 'Arian Protection', 'id_jenis' => 'B001', 'id_size' => "2", 'id_kondisi' => '1', 'image' => null],

            ['id_apd' => 'B-ari-0001', 'nama_apd' => 'Rescue Boots', 'merk' => 'Arian Protection', 'id_jenis' => 'B002', 'id_size' => "2", 'id_kondisi' => '1', 'image' => 'rescue-boots-2020.png'],

            ['id_apd' => 'A-dar-0000', 'nama_apd' => 'Sandstorm', 'merk' => 'Darude', 'id_jenis' => 'A001', 'id_size' => null, 'id_kondisi' => '1', 'image' => 'respirator-2021.png'],

            ['id_apd' => 'A-ari-0000', 'nama_apd' => 'Arian Visor', 'merk' => 'Arian Protection', 'id_jenis' => 'A002', 'id_size' => null, 'id_kondisi' => '1', 'image' => 'uvex.png'],

            ['id_apd' => 'A-tho-0000', 'nama_apd' => 'Handaxe', 'merk' => 'Thorsson and Asgard Production', 'id_jenis' => 'A003', 'id_size' => null, 'id_kondisi' => '1', 'image' => 'kampak.png'],

            ['id_apd' => 'A-uni-0000', 'nama_apd' => 'Flashlight', 'merk' => 'Universal Lightning', 'id_jenis' => 'A004', 'id_size' => null, 'id_kondisi' => '1', 'image' => null],

        ];

        foreach($dataContohApd as $data)
        {
            ApdList::create([
                "id_apd" => $data['id_apd'],
                "nama_apd" => $data['nama_apd'],
                "merk" => $data['merk'],
                "id_jenis" => $data['id_jenis'],
                "id_size" => $data['id_size'],
                "id_kondisi" => $data['id_kondisi'],
                "image" => $data['image']
            ]);
        }

    }
}
