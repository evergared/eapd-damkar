<?php

namespace Database\Seeders;

use App\Models\Eapd\Sql\ApdJenis;
use App\Models\Eapd\Sql\ApdKondisi;
use App\Models\Eapd\Sql\ApdList;
use App\Models\Eapd\Sql\ApdSize;
use App\Models\Eapd\Sql\Grup;
use App\Models\Eapd\Sql\InputApdTemplate;
use App\Models\Eapd\Sql\Jabatan;
use App\Models\Eapd\Sql\Pegawai;
use App\Models\Eapd\Sql\Penempatan;
use App\Models\Eapd\Sql\PeriodeInputApd;
use App\Models\Eapd\Sql\Wilayah;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Enum\LevelUser as lu;
use App\Enum\TipeJabatan as tj;

class TesEapdSeeder extends Seeder
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

        $dataContohApd = [
            ['id_apd' => 'H-bro-0000', 'nama_apd' => 'Fire Helmet', 'merk' => 'Bronson', 'id_jenis' => 'H001', 'id_size' => '1', 'id_kondisi' => '2', 'image' => 'fire-helmet-2021.png'],

            ['id_apd' => 'H-fir-0001', 'nama_apd' => 'Rescue Helmet', 'merk' => 'Rescue Helmet', 'id_jenis' => 'H002', 'id_size' => '1', 'id_kondisi' => '2', 'image' => 'rescue-helmet-2021.png'],

            ['id_apd' => 'G-glo-0000', 'nama_apd' => 'Fire Gloves', 'merk' => 'Fire Gloves', 'id_jenis' => 'G001', 'id_size' => '2', 'id_kondisi' => '1', 'image' => 'fire-glove-2022.png'],

            ['id_apd' => 'G-alt-0001', 'nama_apd' => 'Rescue Gloves', 'merk' => 'Altair Industries', 'id_jenis' => 'G002', 'id_size' => '2', 'id_kondisi' => '1', 'image' => 'rescue-glove-2022.png'],

            ['id_apd' => 'T-fir-0000', 'nama_apd' => 'Fire Jacket', 'merk' => 'Fire Protect', 'id_jenis' => 'T001', 'id_size' => '2', 'id_kondisi' => '1', 'image' => 'fire-jacket-2021.png||fire-jacket-back-2021.png'],

            ['id_apd' => 'T-yoh-0000', 'nama_apd' => 'Jump Suit', 'merk' => 'Yohanes Safety Accredited', 'id_jenis' => 'T002', 'id_size' => '2', 'id_kondisi' => '1', 'image' => 'jumsuit-2022.jpg'],

            ['id_apd' => 'B-yoh-0000', 'nama_apd' => 'Fire Boots', 'merk' => 'Yohanes Safety Accredited', 'id_jenis' => 'B001', 'id_size' => '3', 'id_kondisi' => '1', 'image' => 'fire-boots-2022.png'],

            ['id_apd' => 'B-ari-0001', 'nama_apd' => 'Rescue Boots', 'merk' => 'Arian Protection', 'id_jenis' => 'B002', 'id_size' => '3', 'id_kondisi' => '1', 'image' => 'rescue-boots-2020.png'],

            ['id_apd' => 'A-dar-0000', 'nama_apd' => 'Respirator', 'merk' => 'Darude', 'id_jenis' => 'A001', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'respirator-2021.png'],

            ['id_apd' => 'A-ari-0000', 'nama_apd' => 'Fire Goggles', 'merk' => 'Arian Protection', 'id_jenis' => 'A002', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'uvex.png'],

            ['id_apd' => 'A-tho-0000', 'nama_apd' => 'Kapak', 'merk' => 'Thorsson and Asgard Production', 'id_jenis' => 'A003', 'id_size' => '1', 'id_kondisi' => '1', 'image' => 'kampak.png'],

            ['id_apd' => 'A-uni-0000', 'nama_apd' => 'Flashligh', 'merk' => 'Universal Lightning', 'id_jenis' => 'A004', 'id_size' => '1', 'id_kondisi' => '1'],




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
            'S',
            'M',
            'L',
            'XL',
            'XXL',
            'XXXL'
        );

        $sizeAll = array(
            'All Size'
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
            ['id_jabatan' => 'L001', 'nama_jabatan' => 'PJLP Damkar', 'tipe_jabatan' => tj::personil(), 'keterangan' => null, 'level_user' => lu::anggota()],
            ['id_jabatan' => 'L002', 'nama_jabatan' => 'ASN Damkar', 'tipe_jabatan' => tj::personil(), 'keterangan' => null, 'level_user' => lu::anggota()],
            ['id_jabatan' => 'L003', 'nama_jabatan' => 'Kepala Regu', 'tipe_jabatan' => tj::personil(), 'keterangan' => null, 'level_user' => lu::anggota()],
            ['id_jabatan' => 'L004', 'nama_jabatan' => 'Kepala Pleton', 'tipe_jabatan' => tj::danton(), 'keterangan' => null, 'level_user' => lu::danton()],
            ['id_jabatan' => 'K001', 'nama_jabatan' => 'Kepala Sektor', 'tipe_jabatan' => tj::eselon4(), 'keterangan' => 'Admin Sektor', 'level_user' => lu::adminSektor()],
            ['id_jabatan' => 'K002', 'nama_jabatan' => 'Kasie Dalkarmat', 'tipe_jabatan' => tj::eselon4(), 'keterangan' => 'Admin Sektor', 'level_user' => lu::adminSektor()],
            ['id_jabatan' => 'K003', 'nama_jabatan' => 'Kasie Sarana', 'tipe_jabatan' => tj::eselon4(), 'keterangan' => 'Admin Sudin', 'level_user' => lu::adminSudin()],
            ['id_jabatan' => 'K004', 'nama_jabatan' => 'Kepala Sudin', 'tipe_jabatan' => tj::eselon4(), 'keterangan' => null, 'level_user' => lu::kasudin()],
            ['id_jabatan' => 'K005', 'nama_jabatan' => 'Kepala Bidang Sarpras', 'tipe_jabatan' => tj::eselon4(), 'keterangan' => 'Admin Sarana', 'level_user' => lu::adminDinas()],
            ['id_jabatan' => 'S001', 'nama_jabatan' => 'Staff Sektor', 'tipe_jabatan' => tj::staff(), 'keterangan' => null, 'level_user' => lu::anggota()],
            ['id_jabatan' => 'S002', 'nama_jabatan' => 'Staff Tata Usaha', 'tipe_jabatan' => tj::staff(), 'keterangan' => null, 'level_user' => lu::anggota()],

        ];

        $penempatan = [
            ['id_penempatan' => 'D_1', 'nama_penempatan' => 'Kantor Dinas DKI Jakarta', 'keterangan' => 'dinas'],
            ['id_penempatan' => '11', 'nama_penempatan' => 'Sudin Jakarta Pusat', 'keterangan' => 'sudin'],
            ['id_penempatan' => '1.11', 'nama_penempatan' => 'Sektor I Gambir', 'keterangan' => 'sektor'],
            ['id_penempatan' => '1.11.01', 'nama_penempatan' => 'Kantor Sektor I Gambir', 'keterangan' => 'pos'],
            ['id_penempatan' => '1.11.2', 'nama_penempatan' => 'Pos Tanah Abang', 'keterangan' => 'pos'],
            ['id_penempatan' => '1.11.3', 'nama_penempatan' => 'Pos Bendungan Hilir', 'keterangan' => 'pos'],
            ['id_penempatan' => '1.11.4', 'nama_penempatan' => 'Pos Karet', 'keterangan' => 'pos'],
            ['id_penempatan' => '1.12', 'nama_penempatan' => 'Sektor II Tanah Abang', 'keterangan' => 'sektor'],
            ['id_penempatan' => '2.11', 'nama_penempatan' => 'Sektor I Cilincing', 'keterangan' => 'sektor'],
            ['id_penempatan' => '2.12', 'nama_penempatan' => 'Sektor II Koja', 'keterangan' => 'sektor'],
            ['id_penempatan' => '3.11', 'nama_penempatan' => 'Sektor I Grogol Petamburan', 'keterangan' => 'nektor'],
            ['id_penempatan' => '3.12', 'nama_penempatan' => 'Sektor II Palmerah', 'keterangan' => 'sektor'],
            ['id_penempatan' => '4.11', 'nama_penempatan' => 'Sektor I Kebayoran Lama', 'keterangan' => 'sektor'],
            ['id_penempatan' => '4.12', 'nama_penempatan' => 'Sektor II Kebayoran Baru', 'keterangan' => 'sektor'],
            ['id_penempatan' => '5.11', 'nama_penempatan' => 'Sektor I Matraman', 'keterangan' => 'sektor'],
            ['id_penempatan' => '5.12', 'nama_penempatan' => 'Sektor II Pulo Gadung', 'keterangan' => 'sektor'],
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

        $template = [
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
            ['id_jenis' => 'A004', 'opsi_apd' => ['A-uni-0000']],
        ];

        error_log('populating jenis');
        foreach ($dataJenisItem as $item) {
            ApdJenis::create($item);
        }

        error_log('populating kondisi umum');
        ApdKondisi::create(
            [
                'nama_kondisi' => 'umum',
                'opsi' => $kondisiUmum
            ]
        );

        error_log('populating kondisi helm');
        ApdKondisi::create([
            'nama_kondisi' => 'helm umum',
            'opsi' => $kondisiHelmUmum
        ]);

        error_log('populating size kosong');
        ApdSize::create([
            'nama_size' => 'kosong',
            'opsi' => ['Tidak Memiliki Standar Ukuran']
        ]);

        error_log('populating size umum');
        ApdSize::create([
            'nama_size' => 'umum',
            'opsi' => $sizeUmum
        ]);

        error_log('populating size sepatu');
        ApdSize::create([
            'nama_size' => 'sepatu umum',
            'opsi' => $sizeSepatu
        ]);

        error_log('populating all size');
        ApdSize::create([
            'nama_size' => 'all',
            'opsi' => $sizeAll
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

        error_log('populating template');
        InputApdTemplate::create([
            'template' => $template,
        ]);

        error_log('menyambungkan template dengan jabatan');

        DB::table('pivot_input_apd_template')->insert([
            'id_template' => '1',
            'id_jabatan' => 'L001',
            'id_periode' => '1'

        ]);

        DB::table('pivot_input_apd_template')->insert([
            'id_template' => '1',
            'id_jabatan' => 'L002',
            'id_periode' => '1'
        ]);

        DB::table('pivot_input_apd_template')->insert([
            'id_template' => '1',
            'id_jabatan' => 'L003',
            'id_periode' => '1'
        ]);

        DB::table('pivot_input_apd_template')->insert([
            'id_template' => '1',
            'id_jabatan' => 'L004',
            'id_periode' => '1'
        ]);



        error_log('populating pegawai');
        // Pegawai::factory()->count(50)->create(); //<-- @evergared : di disable sementara karena tidak bisa di laptop saya (linux mint)

        $akun = [];

        $akun[0] = Pegawai::create([
            'nrk' => '80182881',
            'nip' => '3174060110950006',
            'nama' => 'Irawan Maulana',
            'id_jabatan' => 'L004',
            'id_wilayah' => '1',
            'id_penempatan' => '1.11',
            'id_grup' => 'B'
        ]);

        $akun[1] = Pegawai::create([
            'nrk' => '80182810',
            'nip' => '3174093012890004',
            'nama' => 'Indra Purwoko',
            'id_jabatan' => 'L001',
            'id_wilayah' => '1',
            'id_penempatan' => '1.11.01',
            'id_grup' => 'B'
        ]);

        $akun[2] = Pegawai::create([
            'nrk' => '12345678',
            'nip' => '198501242010011005',
            'nama' => 'Rizky Gufara, S.Kom',
            'id_jabatan' => 'K001',
            'id_wilayah' => '1',
            'id_penempatan' => '1.11',
            'id_grup' => 'S'
        ]);

        $akun[3] = Pegawai::create([
            'nrk' => '11',
            'nip' => '11111',
            'nama' => 'Admin Dinas',
            'id_jabatan' => 'K005',
            'id_wilayah' => '1',
            'id_penempatan' => 'D_1',
            'id_grup' => 'S'
        ]);

        $akun[4] = Pegawai::create([
            'nrk' => '2222',
            'nip' => '2222',
            'nama' => 'Admin Sudin',
            'id_jabatan' => 'K003',
            'id_wilayah' => '1',
            'id_penempatan' => '11',
            'id_grup' => 'S'
        ]);

        $akun[5] = Pegawai::create([
            'nrk' => '3333',
            'nip' => '3333',
            'nama' => 'Admin Sektor',
            'id_jabatan' => 'K001',
            'id_wilayah' => '1',
            'id_penempatan' => '1.11',
            'id_grup' => 'S'
        ]);

        $akun[6] = Pegawai::create([
            'nrk' => '4444',
            'nip' => '4444',
            'nama' => 'Test Pegawai',
            'id_jabatan' => 'L001',
            'id_wilayah' => '2',
            'id_penempatan' => '2.11',
            'id_grup' => 'B'
        ]);

        $akun[7] = Pegawai::create([
            'nrk' => '12',
            'nip' => '1122',
            'nama' => 'Kasudin',
            'id_jabatan' => 'K004',
            'id_wilayah' => '1',
            'id_penempatan' => '11',
            'id_grup' => 'S'
        ]);


        // error_log('populating list, sering error disini karena id sering duplicate, bisa cek file ApdListFactory.php jika error');
        // ApdList::factory()->count(20)->create();

        foreach ($dataContohApd as $item) {
            ApdList::create($item);
        }

        error_log('populating user');

        foreach ($akun as $a) {
            error_log('id user : ' . $a->id . ' || ' . 'nama : ' . $a->nama);
            User::create([
                'userid' => $a->id,
                'password' => Hash::make('123456')
            ]);
        }
    }
}
