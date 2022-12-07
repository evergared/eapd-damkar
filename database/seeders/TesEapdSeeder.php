<?php

namespace Database\Seeders;

use App\Models\Eapd\ApdJenis;
use App\Models\Eapd\ApdKondisi;
use App\Models\Eapd\ApdList;
use App\Models\Eapd\ApdSize;
use App\Models\Eapd\Grup;
use App\Models\Eapd\Jabatan;
use App\Models\Eapd\Pegawai;
use App\Models\Eapd\Penempatan;
use App\Models\Eapd\PeriodeInputApd;
use App\Models\Eapd\Wilayah;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TesEapdSeeder extends Seeder
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

        $grup = [
            ['id_grup' => 'A', 'nama_grup' => 'Ambon', 'keterangan' => null],
            ['id_grup' => 'B', 'nama_grup' => 'Bandung', 'keterangan' => null],
            ['id_grup' => 'C', 'nama_grup' => 'Cepu', 'keterangan' => null],
            ['id_grup' => 'S', 'nama_grup' => 'Non Grup', 'keterangan' => null],
        ];

        $jabatan = [
            ['id_jabatan' => 'L001', 'nama_jabatan' => 'PJLP Damkar', 'tipe_jabatan' => 'Personil', 'keterangan' => null],
            ['id_jabatan' => 'L002', 'nama_jabatan' => 'ASN Damkar', 'tipe_jabatan' => 'Personil', 'keterangan' => null],
            ['id_jabatan' => 'L003', 'nama_jabatan' => 'Kepala Regu', 'tipe_jabatan' => 'Personil', 'keterangan' => null],
            ['id_jabatan' => 'L004', 'nama_jabatan' => 'Kepala Pleton', 'tipe_jabatan' => 'Danton', 'keterangan' => null, 'level_user' => 2],
            ['id_jabatan' => 'K001', 'nama_jabatan' => 'Kepala Sektor', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sektor', 'level_user' => 3],
            ['id_jabatan' => 'K002', 'nama_jabatan' => 'Kasie Dalkarmat', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sektor', 'level_user' => 3],
            ['id_jabatan' => 'K003', 'nama_jabatan' => 'Kasie Sarana', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sudin', 'level_user' => 4],
            ['id_jabatan' => 'K004', 'nama_jabatan' => 'Kepala Sudin', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => null],
            ['id_jabatan' => 'K005', 'nama_jabatan' => 'Kepala Bidang Sarpras', 'tipe_jabatan' => 'Eselon 4', 'keterangan' => 'Admin Sarana', 'level_user' => 5],
            ['id_jabatan' => 'S001', 'nama_jabatan' => 'Staff Sektor', 'tipe_jabatan' => 'Staff', 'keterangan' => null],
            ['id_jabatan' => 'S002', 'nama_jabatan' => 'Staff Tata Usaha', 'tipe_jabatan' => 'Staff', 'keterangan' => null],

        ];

        $penempatan = [
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

        $wilayah = [
            ['id_wilayah' => '1', 'nama_wilayah' => 'Jakarta Pusat', 'keterangan' => null],
            ['id_wilayah' => '2', 'nama_wilayah' => 'Jakarta Utara', 'keterangan' => null],
            ['id_wilayah' => '3', 'nama_wilayah' => 'Jakarta Barat', 'keterangan' => null],
            ['id_wilayah' => '4', 'nama_wilayah' => 'Jakarta Selatan', 'keterangan' => null],
            ['id_wilayah' => '5', 'nama_wilayah' => 'Jakarta Timur', 'keterangan' => null],
        ];

        $periode = [
            'nama_periode' => 'triwulan 2023',
            'tgl_awal' => '2023-01-01',
            'tgl_akhir' => '2023-04-01'
        ];

        error_log('populating jenis');
        foreach ($dataJenisItem as $item) {
            ApdJenis::create($item);
        }

        error_log('populating kondisi umum');
        ApdKondisi::create(
            [
                'nama_kondisi' => 'umum',
                'opsi' => json_encode($kondisiUmum)
            ]
        );

        error_log('populating kondisi helm');
        ApdKondisi::create([
            'nama_kondisi' => 'helm umum',
            'opsi' => json_encode($kondisiHelmUmum)
        ]);

        error_log('populating size umum');
        ApdSize::create([
            'nama_size' => 'umum',
            'opsi' => json_encode($sizeUmum)
        ]);

        error_log('populating size sepatu');
        ApdSize::create([
            'nama_size' => 'sepatu umum',
            'opsi' => json_encode($sizeSepatu)
        ]);

        error_log('populating grup');
        foreach ($grup as $i) {
            Grup::create($i);
        }

        error_log('populating jabatan');
        foreach ($jabatan as $item) {
            Jabatan::create($item);
        }

        error_log('populating penempatan');
        foreach ($penempatan as $item) {
            Penempatan::create($item);
        }

        error_log('populating wilayah');
        foreach ($wilayah as $item) {
            Wilayah::create($item);
        }

        error_log('populating periode');
        PeriodeInputApd::create($periode);

        error_log('populating pegawai');
        Pegawai::factory()->count(50)->create();

        Pegawai::create([
            'nrk' => '80182881',
            'nip' => '3174060110950006',
            'nama' => 'Irawan Maulana',
            'id_jabatan' => 'L004',
            'id_wilayah' => '1',
            'id_penempatan' => '1.11',
            'id_grup' => 'B'
        ]);

        Pegawai::create([
            'nrk' => '80182810',
            'nip' => '3174093012890004',
            'nama' => 'Indra Purwoko',
            'id_jabatan' => 'L001',
            'id_wilayah' => '1',
            'id_penempatan' => '1.11',
            'id_grup' => 'B'
        ]);

        Pegawai::create([
            'nrk' => '12345678',
            'nip' => '198501242010011005',
            'nama' => 'Rizky Gufara, S.Kom',
            'id_jabatan' => 'K001',
            'id_wilayah' => '1',
            'id_penempatan' => '1.11',
            'id_grup' => 'S'
        ]);

        Pegawai::create([
            'nrk' => '11',
            'nip' => '11111',
            'nama' => 'Super Admin',
            'id_jabatan' => 'K005',
            'id_wilayah' => '1',
            'id_penempatan' => '1.11',
            'id_grup' => 'S'
        ]);


        error_log('populating list, sering error disini karena id sering duplicate, bisa cek file ApdListFactory.php jika error');
        ApdList::factory()->count(20)->create();

        error_log('populating user');
        User::create([
            'nrk' => '80182881',
            'password' => Hash::make('123456')
        ]);

        User::create([
            'nrk' => '80182810',
            'password' => Hash::make('123456')
        ]);

        User::create([
            'nrk' => '12345678',
            'password' => Hash::make('123456')
        ]);
    }
}