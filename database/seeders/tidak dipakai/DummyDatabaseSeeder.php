<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DummyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        ];

        $dataJabatan = [
            ['id_jabatan' => 'L001', 'nama_jabatan' => 'PJLP Damkar', 'tipe_jabatan' => 'Personil', 'keterangan' => null],
            ['id_jabatan' => 'L002', 'nama_jabatan' => 'ASN Damkar', 'tipe_jabatan' => 'Personil', 'keterangan' => null],
            ['id_jabatan' => 'L003', 'nama_jabatan' => 'Kepala Regu', 'tipe_jabatan' => 'Personil', 'keterangan' => null],
            ['id_jabatan' => 'L004', 'nama_jabatan' => 'Kepala Pleton', 'tipe_jabatan' => 'Danton', 'keterangan' => null],
            ['id_jabatan' => 'K001', 'nama_jabatan' => 'Kepala Sektor', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sektor'],
            ['id_jabatan' => 'K002', 'nama_jabatan' => 'Kasie Dalkarmat', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sektor'],
            ['id_jabatan' => 'K003', 'nama_jabatan' => 'Kasie Sarana', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sudin'],
            ['id_jabatan' => 'K004', 'nama_jabatan' => 'Kepala Sudin', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => null],
            ['id_jabatan' => 'K005', 'nama_jabatan' => 'Kepala Bidang Sarpras', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sarana'],
            ['id_jabatan' => 'S001', 'nama_jabatan' => 'Staff Sektor', 'tipe_jabatan' => 'Staff', 'keterangan' => null],
            ['id_jabatan' => 'S002', 'nama_jabatan' => 'Staff Tata Usaha', 'tipe_jabatan' => 'Staff', 'keterangan' => null],
        ];

        $dataWilayah = [
            ['id_wilayah' => '1', 'nama_wilayah' => 'Jakarta Pusat', 'keterangan' => null],
            ['id_wilayah' => '2', 'nama_wilayah' => 'Jakarta Utara', 'keterangan' => null],
            ['id_wilayah' => '3', 'nama_wilayah' => 'Jakarta Barat', 'keterangan' => null],
            ['id_wilayah' => '4', 'nama_wilayah' => 'Jakarta Selatan', 'keterangan' => null],
            ['id_wilayah' => '5', 'nama_wilayah' => 'Jakarta Timur', 'keterangan' => null],
        ];

        $dataPenempatan = [
            ['id_penempatan' => '1.11', 'nama_penempatan' => 'Gambir', 'keterangan' => null],
            ['id_penempatan' => '1.12', 'nama_penempatan' => 'Tanah Abang', 'keterangan' => null],
            ['id_penempatan' => '2.11', 'nama_penempatan' => 'Cilincing', 'keterangan' => null],
            ['id_penempatan' => '2.12', 'nama_penempatan' => 'Koja', 'keterangan' => null],
            ['id_penempatan' => '3.11', 'nama_penempatan' => 'Grogol Petamburan', 'keterangan' => null],
            ['id_penempatan' => '3.12', 'nama_penempatan' => 'Palmerah', 'keterangan' => null],
            ['id_penempatan' => '4.11', 'nama_penempatan' => 'Kebayoran Lama', 'keterangan' => null],
            ['id_penempatan' => '4.12', 'nama_penempatan' => 'Kebayoran Baru', 'keterangan' => null],
            ['id_penempatan' => '5.11', 'nama_penempatan' => 'Matraman', 'keterangan' => null],
            ['id_penempatan' => '5.12', 'nama_penempatan' => 'Pulo Gadung', 'keterangan' => null],
        ];

        $dataGrup = [
            ['id_grup' => 'A', 'nama_grup' => 'Ambon', 'keterangan' => null],
            ['id_grup' => 'B', 'nama_grup' => 'Bandung', 'keterangan' => null],
            ['id_grup' => 'C', 'nama_grup' => 'Cepu', 'keterangan' => null],
            ['id_grup' => 'S', 'nama_grup' => 'Non Grup', 'keterangan' => null],
        ];

        $dataKondisi = [
            'Baik',
            'Rusak Ringan',
            'Rusak Sedang',
            'Rusak Berat'
        ];

        $dataKeberadaan = [
            'Ada/Sudah Terima',
            'Hilang',
            'Belum Terima'
        ];

        $dataSize = [
            'XL',
            'L',
            'M',
            'S'
        ];

        foreach ($dataJenisItem as $data) {
            DB::table('tes_jenis_item')->insert($data);

            $item1 = str_replace(" ", "", $data['nama_jenis']) . '_1';
            $item1 = strtolower($item1);

            $item2 = str_replace(" ", "", $data['nama_jenis']) . '_2';
            $item2 = strtolower($item2);

            DB::table('tes_list_item')->insert([
                'id_item' => Str::random(4),
                'id_jenis' => $data['id_jenis'],
                'nama_item' => $data['nama_jenis'] . ' 1',
                'image' => asset('img/apd/placeholder/' . $item1 . '.jpg'),
                'merk' => fake('en_US')->word,
            ]);

            DB::table('tes_list_item')->insert([
                'id_item' => Str::random(4),
                'id_jenis' => $data['id_jenis'],
                'nama_item' => $data['nama_jenis'] . ' 1',
                'image' => asset('img/apd/placeholder/' . $item2 . '.jpg'),
                'merk' => fake('en_US')->word,
                'ingub' => 1,
                'pengadaan' => '2022'
            ]);
        }

        foreach ($dataJabatan as $data) {
            DB::table('tes_jabatan')->insert($data);
        }

        foreach ($dataWilayah as $data) {
            DB::table('tes_wilayah')->insert($data);
        }

        foreach ($dataPenempatan as $data) {
            DB::table('tes_penempatan')->insert($data);
        }

        foreach ($dataGrup as $data) {
            DB::table('tes_grup')->insert($data);
        }

        for ($i = 0; $i < 30; $i++) {
            DB::table('tes_pegawai')->insert([
                'nrk' => Str::random(8),
                'nip' => Str::random(16),
                'nama' => fake('id_ID')->name,
                'id_jabatan' => $dataJabatan[rand(0, count($dataJabatan) - 1)]['id_jabatan'],
                'id_wilayah' => $dataWilayah[rand(0, count($dataWilayah) - 1)]['id_wilayah'],
                'id_penempatan' => $dataPenempatan[rand(0, count($dataPenempatan) - 1)]['id_penempatan'],
                'id_grup' => $dataGrup[rand(0, count($dataGrup) - 1)]['id_grup'],
            ]);
        }

        DB::table('tes_pegawai')->insert([
            'nrk' => '80182881',
            'nip' => '3174060110950006',
            'nama' => 'Irawan Maulana',
            'id_jabatan' => 'L001',
            'id_wilayah' => '1',
            'id_penempatan' => '1.11',
            'id_grup' => 'B'
        ]);

        DB::table('tes_pegawai')->insert([
            'nrk' => '80182810',
            'nip' => '3174093012890004',
            'nama' => 'Indra Purwoko',
            'id_jabatan' => 'L001',
            'id_wilayah' => '3',
            'id_penempatan' => '3.11',
            'id_grup' => 'B'
        ]);

        DB::table('tes_user')->insert([
            'nrk' => '80182881',
            'password' => Hash::make('123456')
        ]);

        DB::table('tes_user')->insert([
            'nrk' => '80182810',
            'password' => Hash::make('123456')
        ]);
    }
}
