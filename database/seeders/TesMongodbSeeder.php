<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Enum\LevelUser as lu;
use App\Enum\TipeJabatan as tj;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdKondisi;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\ApdSize;
use App\Models\Eapd\Mongodb\Grup;
use App\Models\Eapd\Mongodb\InputApdTemplate;
use App\Models\Eapd\Mongodb\Jabatan;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\Penempatan;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use App\Models\Eapd\Mongodb\Wilayah;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TesMongodbSeeder extends Seeder
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
            ['_id' => 'H001', 'nama_jenis' => 'Fire Helmet', 'keterangan' => null],
            ['_id' => 'H002', 'nama_jenis' => 'Rescue Helmet', 'keterangan' => null],
            ['_id' => 'T001', 'nama_jenis' => 'Fire Jacket', 'keterangan' => null],
            ['_id' => 'T002', 'nama_jenis' => 'Jumpsuit', 'keterangan' => null],
            ['_id' => 'G001', 'nama_jenis' => 'Fire Gloves', 'keterangan' => null],
            ['_id' => 'G002', 'nama_jenis' => 'Rescue Gloves', 'keterangan' => null],
            ['_id' => 'B001', 'nama_jenis' => 'Fire Boots', 'keterangan' => null],
            ['_id' => 'B002', 'nama_jenis' => 'Rescue Boots', 'keterangan' => null],
            ['_id' => 'A001', 'nama_jenis' => 'Respirator', 'keterangan' => null],
            ['_id' => 'A002', 'nama_jenis' => 'Fire Goggles', 'keterangan' => null],
            ['_id' => 'A003', 'nama_jenis' => 'Kapak', 'keterangan' => null],
            ['_id' => 'A004', 'nama_jenis' => 'Senter', 'keterangan' => null],
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
            ['_id' => 'L001', 'nama_jabatan' => 'PJLP Damkar', 'tipe_jabatan' => tj::personil()->value, 'keterangan' => null, 'level_user' => lu::anggota()->value],
            ['_id' => 'L002', 'nama_jabatan' => 'ASN Damkar', 'tipe_jabatan' => tj::personil()->value, 'keterangan' => null, 'level_user' => lu::anggota()->value],
            ['_id' => 'L003', 'nama_jabatan' => 'Kepala Regu', 'tipe_jabatan' => tj::personil()->value, 'keterangan' => null, 'level_user' => lu::anggota()->value],
            ['_id' => 'L004', 'nama_jabatan' => 'Kepala Pleton', 'tipe_jabatan' => tj::danton()->value, 'keterangan' => null, 'level_user' => lu::danton()->value],
            ['_id' => 'K001', 'nama_jabatan' => 'Kepala Sektor', 'tipe_jabatan' => tj::eselon4()->value, 'keterangan' => 'Admin Sektor', 'level_user' => lu::adminSektor()->value],
            ['_id' => 'K002', 'nama_jabatan' => 'Kasie Dalkarmat', 'tipe_jabatan' => tj::eselon4()->value, 'keterangan' => 'Admin Sektor', 'level_user' => lu::adminSektor()->value],
            ['_id' => 'K003', 'nama_jabatan' => 'Kasie Sarana', 'tipe_jabatan' => tj::eselon4()->value, 'keterangan' => 'Admin Sudin', 'level_user' => lu::adminSudin()->value],
            ['_id' => 'K004', 'nama_jabatan' => 'Kepala Sudin', 'tipe_jabatan' => tj::eselon4()->value, 'keterangan' => null, 'level_user' => lu::kasudin()->value],
            ['_id' => 'K005', 'nama_jabatan' => 'Kepala Bidang Sarpras', 'tipe_jabatan' => tj::eselon4()->value, 'keterangan' => 'Admin Sarana', 'level_user' => lu::adminDinas()->value],
            ['_id' => 'S001', 'nama_jabatan' => 'Staff Sektor', 'tipe_jabatan' => tj::staff()->value, 'keterangan' => null, 'level_user' => lu::anggota()->value],
            ['_id' => 'S002', 'nama_jabatan' => 'Staff Tata Usaha', 'tipe_jabatan' => tj::staff()->value, 'keterangan' => null, 'level_user' => lu::anggota()->value],

        ];

        $penempatan = [
            ['_id' => 'D_1', 'nama_penempatan' => 'Kantor Dinas DKI Jakarta', 'keterangan' => 'dinas'],
            ['_id' => '11', 'nama_penempatan' => 'Sudin Jakarta Pusat', 'keterangan' => 'sudin'],
            ['_id' => '1.11', 'nama_penempatan' => 'Sektor I Gambir', 'keterangan' => 'sektor'],
            ['_id' => '1.11.01', 'nama_penempatan' => 'Kantor Sektor I Gambir', 'keterangan' => 'pos'],
            ['_id' => '1.11.2', 'nama_penempatan' => 'Pos Tanah Abang', 'keterangan' => 'pos'],
            ['_id' => '1.11.3', 'nama_penempatan' => 'Pos Bendungan Hilir', 'keterangan' => 'pos'],
            ['_id' => '1.11.4', 'nama_penempatan' => 'Pos Karet', 'keterangan' => 'pos'],
            ['_id' => '1.12', 'nama_penempatan' => 'Sektor II Tanah Abang', 'keterangan' => 'sektor'],
            ['_id' => '2.11', 'nama_penempatan' => 'Sektor I Cilincing', 'keterangan' => 'sektor'],
            ['_id' => '2.12', 'nama_penempatan' => 'Sektor II Koja', 'keterangan' => 'sektor'],
            ['_id' => '3.11', 'nama_penempatan' => 'Sektor I Grogol Petamburan', 'keterangan' => 'nektor'],
            ['_id' => '3.12', 'nama_penempatan' => 'Sektor II Palmerah', 'keterangan' => 'sektor'],
            ['_id' => '4.11', 'nama_penempatan' => 'Sektor I Kebayoran Lama', 'keterangan' => 'sektor'],
            ['_id' => '4.12', 'nama_penempatan' => 'Sektor II Kebayoran Baru', 'keterangan' => 'sektor'],
            ['_id' => '5.11', 'nama_penempatan' => 'Sektor I Matraman', 'keterangan' => 'sektor'],
            ['_id' => '5.12', 'nama_penempatan' => 'Sektor II Pulo Gadung', 'keterangan' => 'sektor'],
        ];


        $wilayah = [
            ['_id' => '1', 'nama_wilayah' => 'Jakarta Pusat', 'keterangan' => null],
            ['_id' => '2', 'nama_wilayah' => 'Jakarta Utara', 'keterangan' => null],
            ['_id' => '3', 'nama_wilayah' => 'Jakarta Barat', 'keterangan' => null],
            ['_id' => '4', 'nama_wilayah' => 'Jakarta Selatan', 'keterangan' => null],
            ['_id' => '5', 'nama_wilayah' => 'Jakarta Timur', 'keterangan' => null],
        ];

        $periode = [
            'nama_periode' => 'triwulan 2023',
            'tgl_awal' => '2023-01-01',
            'tgl_akhir' => '2023-04-01'
        ];

        $template = [
            ['id_jenis' => 'H002', 'opsi_apd' => ['H-fir-0001']],
            ['id_jenis' => 'H001', 'opsi_apd' => ['H-bro-0000', 'H-fir-0000', 'H-bro-0001']],
            ['id_jenis' => 'G001', 'opsi_apd' => ['G-glo-0000', 'G-glo-0001', 'G-alt-0000']],
            ['id_jenis' => 'G002', 'opsi_apd' => ['G-alt-0001', 'G-alt-0002']],
            ['id_jenis' => 'T001', 'opsi_apd' => ['T-fir-0000', 'T-pol-0000']],
            ['id_jenis' => 'T002', 'opsi_apd' => ['T-yoh-0000', 'T-pol-0001']],
            ['id_jenis' => 'B001', 'opsi_apd' => ['B-yoh-0000', 'B-ari-0000']],
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
        $kondisi_umum = ApdKondisi::create(
            [
                'nama_kondisi' => 'umum',
                'opsi' => $kondisiUmum
            ]
        );

        error_log('populating kondisi helm');
        $kondisi_helm = ApdKondisi::create([
            'nama_kondisi' => 'helm umum',
            'opsi' => $kondisiHelmUmum
        ]);

        error_log('populating size kosong');
        $size_kosong = ApdSize::create([
            'nama_size' => 'kosong',
            'opsi' => ['Tidak Memiliki Standar Ukuran']
        ]);

        error_log('populating size umum');
        $size_umum = ApdSize::create([
            'nama_size' => 'umum',
            'opsi' => $sizeUmum
        ]);

        error_log('populating size sepatu');
        $size_sepatu_umum = ApdSize::create([
            'nama_size' => 'sepatu umum',
            'opsi' => $sizeSepatu
        ]);

        error_log('populating grup');
        foreach ($grup as $i) {
            Grup::create($i);
        }

        error_log('populating jabatan');
        $jab = [];
        foreach ($jabatan as $item) {
            $i = Jabatan::create($item);
            array_push($jab,$i->id);
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
        $per = PeriodeInputApd::create($periode);

        error_log('populating template');
        $tmp = InputApdTemplate::create([
            'periode' => [$per->id],
            'jabatan' => $jab,
            'template' => $template,
        ]);

        DB::collection('pivot_input_apd_template')->insert([
            'template_input_apd_id' => $tmp->id,
            'jabatan_id' => 'L001',
            'periode_input_apd_id' => $per->id

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
            'id_wilayah' => '2',
            'id_penempatan' => '2.11',
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

        error_log('populating apd list');

        $dataContohApd = [
            ['_id' => 'H-bro-0000', 'nama_apd' => 'Protect Red', 'merk' => 'Bronson', 'id_jenis' => 'H001', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_helm->id, 'image' => 'fire-helmet-2021.png'],
            ['_id' => 'H-bro-0001', 'nama_apd' => 'Alpha Head', 'merk' => 'Bronson', 'id_jenis' => 'H001', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_helm->id, 'image' => 'firehelmet_4.jpg||firehelmet_5.jpg'],
            ['_id' => 'H-fir-0000', 'nama_apd' => 'Helmet Fire', 'merk' => 'Fire Protect', 'id_jenis' => 'H001', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_helm->id, 'image' => 'firehelmet_6.jpg'],

            ['_id' => 'H-fir-0001', 'nama_apd' => 'Red Helmet', 'merk' => 'Fire Protect', 'id_jenis' => 'H002', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_helm->id, 'image' => 'rescue-helmet-2021.png'],

            ['_id' => 'G-glo-0000', 'nama_apd' => 'Red Hand', 'merk' => 'Gloves Maker', 'id_jenis' => 'G001', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'fire-glove-2022.png'],
            ['_id' => 'G-glo-0001', 'nama_apd' => 'Yellow Hand', 'merk' => 'Gloves Maker', 'id_jenis' => 'G001', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'firegloves_2.jpg'],
            ['_id' => 'G-alt-0000', 'nama_apd' => 'Safety Gloves', 'merk' => 'Altair Industries', 'id_jenis' => 'G001', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'firegloves_1.jpg||firegloves_2.jpg'],

            ['_id' => 'G-alt-0001', 'nama_apd' => 'Rescue Gloves', 'merk' => 'Altair Industries', 'id_jenis' => 'G002', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'rescue-glove-2022.png'],
            ['_id' => 'G-alt-0002', 'nama_apd' => 'Slightly More Safety Gloves', 'merk' => 'Altair Industries', 'id_jenis' => 'G002', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'rescuegloves_2.jpg'],


            ['_id' => 'T-fir-0000', 'nama_apd' => 'Fire Jacket', 'merk' => 'Fire Protect', 'id_jenis' => 'T001', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'fire-jacket-2021.png||fire-jacket-back-2021.png'],
            ['_id' => 'T-pol-0000', 'nama_apd' => 'Fire Suit', 'merk' => 'Poland Inc', 'id_jenis' => 'T001', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_umum->id],

            ['_id' => 'T-pol-0001', 'nama_apd' => 'Jump Suit Poland', 'merk' => 'Poland Inc', 'id_jenis' => 'T002', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'jumsuit-2022.jpg'],
            ['_id' => 'T-yoh-0000', 'nama_apd' => 'Jump Suit', 'merk' => 'Yohanes Safety Accredited', 'id_jenis' => 'T002', 'id_size' =>$size_umum->id, 'id_kondisi' => $kondisi_umum->id],

            ['_id' => 'B-yoh-0000', 'nama_apd' => 'Fire Hazard Boots', 'merk' => 'Yohanes Safety Accredited', 'id_jenis' => 'B001', 'id_size' => $size_sepatu_umum->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'fire-boots-2022.png'],
            ['_id' => 'B-ari-0000', 'nama_apd' => 'Fire Safety Boots', 'merk' => 'Arian Protection', 'id_jenis' => 'B001', 'id_size' => $size_sepatu_umum->id, 'id_kondisi' => $kondisi_umum->id],

            ['_id' => 'B-ari-0001', 'nama_apd' => 'Rescue Boots', 'merk' => 'Arian Protection', 'id_jenis' => 'B002', 'id_size' => $size_sepatu_umum->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'rescue-boots-2020.png'],

            ['_id' => 'A-dar-0000', 'nama_apd' => 'Sandstorm', 'merk' => 'Darude', 'id_jenis' => 'A001', 'id_size' => $size_kosong->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'respirator-2021.png'],

            ['_id' => 'A-ari-0000', 'nama_apd' => 'Arian Visor', 'merk' => 'Arian Protection', 'id_jenis' => 'A002', 'id_size' => $size_kosong->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'uvex.png'],

            ['_id' => 'A-tho-0000', 'nama_apd' => 'Handaxe', 'merk' => 'Thorsson and Asgard Production', 'id_jenis' => 'A003', 'id_size' => $size_kosong->id, 'id_kondisi' => $kondisi_umum->id, 'image' => 'kampak.png'],

            ['_id' => 'A-uni-0000', 'nama_apd' => 'Flashlight', 'merk' => 'Universal Lightning', 'id_jenis' => 'A004', 'id_size' => $size_kosong->id, 'id_kondisi' => $kondisi_umum->id],

        ];

        foreach ($dataContohApd as $item) {
            ApdList::insert($item);
        }

        error_log('populating user');

        foreach($akun as $a){
            error_log('id user : '.$a->id.' || '.'nama : '.$a->nama);
            User::create([
                '_id' => $a->id,
                'password' => Hash::make('123456')
            ]);
        }

    }
}
