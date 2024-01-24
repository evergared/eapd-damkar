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
            ['id_apd' => 'A001_Sun_0001','nama_apd' => 'Respirator','id_jenis' => 'A001','merk' => 'Sundstrom','id_size' => null,'id_kondisi' => '1','image' => 'A001_Sun_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'A002_Uve_0001','nama_apd' => 'Fire Google','id_jenis' => 'A002','merk' => 'Uvex','id_size' => null,'id_kondisi' => '1','image' => 'A002_Uve_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'A003_Sta_0001','nama_apd' => 'Kapak','id_jenis' => 'A003','merk' => 'Starkpro','id_size' => null,'id_kondisi' => '1','image' => 'A003_Sta_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'A004_Pel_0001','nama_apd' => 'Senter Kepala','id_jenis' => 'A004','merk' => 'Pelican','id_size' => null,'id_kondisi' => '1','image' => 'A004_Pel_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'A005_Nom_0001','nama_apd' => 'Balaclava','id_jenis' => 'A005','merk' => 'Nomex','id_size' => null,'id_kondisi' => '1','image' => 'A005_Nom_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'A006_Pem_0001','nama_apd' => 'Pelindung Lutut','id_jenis' => 'A006','merk' => 'Pemadam','id_size' => null,'id_kondisi' => '1','image' => 'A006_Pem_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'A007_Pem_0001','nama_apd' => 'Pelindung Siku','id_jenis' => 'A007','merk' => 'Pemadam','id_size' => null,'id_kondisi' => '1','image' => 'A007_Pem_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'A008_Pem_0001','nama_apd' => 'Tas Pemadam','id_jenis' => 'A008','merk' => 'Pemadam','id_size' => null,'id_kondisi' => '1','image' => 'A008_Pem_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'B001_Har_0001','nama_apd' => 'Fire Boots','id_jenis' => 'B001','merk' => 'Harvik','id_size' => '2','id_kondisi' => '1','image' => 'B001_Har_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'B002_Com_0001','nama_apd' => 'Rescue Boots','id_jenis' => 'B002','merk' => 'Comfy','id_size' => '2','id_kondisi' => '1','image' => 'B002_Com_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'B002_Her_0001','nama_apd' => 'Rescue Boots Heritage','id_jenis' => 'B002','merk' => 'Heritage ','id_size' => '2','id_kondisi' => '1','image' => 'B002_Her_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'B003_Her_0001','nama_apd' => 'Water Rescue Boots','id_jenis' => 'B003','merk' => 'Heritage','id_size' => '2','id_kondisi' => '1','image' => 'B003_Her_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'G001_Car_0001','nama_apd' => 'Fire Gloves','id_jenis' => 'G001','merk' => 'Carbon X','id_size' => '1','id_kondisi' => '1','image' => 'G001_Car_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'G002_Zhi_0001','nama_apd' => 'Rescue Gloves','id_jenis' => 'G002','merk' => 'Zhield','id_size' => '1','id_kondisi' => '1','image' => 'G002_Zhi_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'H001_Cal_0001','nama_apd' => 'Fire Helmet','id_jenis' => 'H001','merk' => 'Calisa Vulcan','id_size' => null,'id_kondisi' => '2','image' => 'H001_Cal_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'H002_Dra_0001','nama_apd' => 'Recue Helmet','id_jenis' => 'H002','merk' => 'Drager','id_size' => null,'id_kondisi' => '2','image' => 'H002_Dra_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'T001_Pem_0001','nama_apd' => 'Fire Jacket','id_jenis' => 'T001','merk' => 'Pemadam','id_size' => '1','id_kondisi' => '1','image' => 'T001_Pem_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
            ['id_apd' => 'T002_Pem_0001','nama_apd' => 'Jumsuit','id_jenis' => 'T002','merk' => 'Pemadam','id_size' => '1','id_kondisi' => '1','image' => 'T002_Pem_0001.jpg','input_no_seri' => '0','strict_no_seri' => '0','id_referensi' => null,'sumber_id_referensi' => null,'deleted_at' => null],
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
