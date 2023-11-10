<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_jabatan = [
            ['id_jabatan' => 'PJLPK', 'nama_jabatan' => 'Petugas Penanganan Penanggulangan Kebakaran Tipe A'],
            ['nama_jabatan' => 'Analis Kebakaran', 'id_jabatan' => 'AKB01', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Kebakaran(Ketua Subkelompok Pengendalian Operasi)', 'id_jabatan' => 'AKJS001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Kebakaran Ahli Madya', 'id_jabatan' => 'AKAM001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Kebakaran Ahli Muda', 'id_jabatan' => 'AKAMD001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Kebakaran Ahli Muda(Ketua Subkelompok Pengawasan Keselamatan Kebakaran)', 'id_jabatan' => 'AKAMD002', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Kebakaran Ahli Pertama', 'id_jabatan' => 'AKAP001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Kebakaran(Ketua Subkelompok Sistem Informasi)', 'id_jabatan' => 'AKKSI001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Kerjasama', 'id_jabatan' => 'AKR001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Kreasi Dan Produksi Musik', 'id_jabatan' => 'AKPM001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Pelaksanaan Program Pengembangan Pendidikan', 'id_jabatan' => 'APPP001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Pembelajaran Kursus Dan Pelatihan', 'id_jabatan' => 'APKP001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Pengembangan Sarana Dan Prasarana', 'id_jabatan' => 'APSP001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Sar', 'id_jabatan' => 'AS001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Sdm Aparatur', 'id_jabatan' => 'ASA001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Sdm Aparatur Ahli Pertama', 'id_jabatan' => 'ASAAP001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Standar Mutu Bahan Dan Peralatan', 'id_jabatan' => 'ASMBP001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Sumber Daya Manusia Aparatur Ahli Madya', 'id_jabatan' => 'ASDMMY001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Sumber Daya Manusia Aparatur Ahli Muda', 'id_jabatan' => 'ASDMMD001', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Sumber Daya Manusia Aparatur Ahli Muda(Ketua Subkelompok Kepegawaian)', 'id_jabatan' => 'ASDMMDKS1', 'keterangan' => null],
            ['nama_jabatan' => 'Analis Sumber Daya Manusia Aparatur Ahli Pertama', 'id_jabatan' => 'ASDMP001', 'keterangan' => null],
            ['nama_jabatan' => 'Arsiparis Ahli Muda', 'id_jabatan' => 'ASDMAAP001', 'keterangan' => null],
            ['nama_jabatan' => 'Arsiparis Ahli Pertama', 'id_jabatan' => 'AAMD001', 'keterangan' => null],
            ['nama_jabatan' => 'Arsiparis Mahir', 'id_jabatan' => 'ARAP001', 'keterangan' => null],
            ['nama_jabatan' => 'Arsiparis Penyelia', 'id_jabatan' => 'ARM001', 'keterangan' => null],
            ['nama_jabatan' => 'Arsiparis Terampil', 'id_jabatan' => 'ARTP001', 'keterangan' => null],
            ['nama_jabatan' => 'Bendahara', 'id_jabatan' => 'BD001', 'keterangan' => null],
            ['nama_jabatan' => 'Bendahara Pembantu', 'id_jabatan' => 'BD002', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Bidang Kerjasama Dan Informasi', 'id_jabatan' => 'KB001', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Dinas Penanggulangan Kebakaran Dan Penyelamatan', 'id_jabatan' => 'KD01', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Laboratorium Kebakaran Dan Penyelamatan', 'id_jabatan' => 'KLKP001', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Pusat Pendidikan Dan Pelatihan  Penanggulangan Kebakaran Dan Penyelamatan', 'id_jabatan' => 'KPPK001', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Seksi Data Dan Informasi', 'id_jabatan' => 'KS001', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Sektor Penanggulangan Kebakaran Dan Penyelamatan', 'id_jabatan' => 'KSK001', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Subbagian Keuangan', 'id_jabatan' => 'KSBK001', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Subbagian Tata Usaha', 'id_jabatan' => 'KSBTU001', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Subbagian Umum', 'id_jabatan' => 'KSBU001', 'keterangan' => null],
            ['nama_jabatan' => 'Kepala Suku Dinas Penanggulangan Kebakaran Dan Penyelamatan', 'id_jabatan' => 'KSUD001', 'keterangan' => null],
            ['nama_jabatan' => 'Ketua Satuan Pelaksana Investigasi Kebakaran', 'id_jabatan' => 'KSPLIK001', 'keterangan' => null],
            ['nama_jabatan' => 'Ketua Satuan Pelaksana Pendidikan Dan Pelatihan', 'id_jabatan' => 'KSPLPP001', 'keterangan' => null],
            ['nama_jabatan' => 'Ketua Satuan Pelaksana Pengembangan Pendidikan Dan Pelatihan', 'id_jabatan' => 'KSPLPDK001', 'keterangan' => null],
            ['nama_jabatan' => 'Ketua Satuan Pelaksana Pengujian Mutu', 'id_jabatan' => 'KSPLM001', 'keterangan' => null],
            ['nama_jabatan' => 'Ketua Satuan Pelaksana Prasarana Dan Sarana', 'id_jabatan' => 'KSPLPS001', 'keterangan' => null],
            ['nama_jabatan' => 'Pemadam Kebakaran Mahir', 'id_jabatan' => 'PKM001', 'keterangan' => null],
            ['nama_jabatan' => 'Pemadam Kebakaran Pemula', 'id_jabatan' => 'PKP001', 'keterangan' => null],
            ['nama_jabatan' => 'Pemadam Kebakaran Penyelia', 'id_jabatan' => 'PKPY001', 'keterangan' => null],
            ['nama_jabatan' => 'Pemadam Kebakaran Terampil', 'id_jabatan' => 'PKT001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengadministrasi Contoh Uji', 'id_jabatan' => 'PADCU001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengadministrasi Kepegawaian', 'id_jabatan' => 'PADPEG001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengadministrasi Keuangan', 'id_jabatan' => 'PADKEU001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengadministrasi Operasional Pemadam Kebakaran (Danru)', 'id_jabatan' => 'PADOPS001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengadministrasi Operasional Pemeliharaan Dan Perbaikan', 'id_jabatan' => 'PADOPP001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengadministrasi Persuratan', 'id_jabatan' => 'PADS001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengadministrasi Pimpinan', 'id_jabatan' => 'PADPIM001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengadministrasi Prasarana Dan Sarana', 'id_jabatan' => 'PADSAR001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengadministrasi Umum', 'id_jabatan' => 'PADU001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Bahan Informasi', 'id_jabatan' => 'PGBI001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Bangunan Gedung', 'id_jabatan' => 'PGBG001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Data Laporan Keuangan', 'id_jabatan' => 'PGDKEU001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Jaringan Komunikasi', 'id_jabatan' => 'PGJK001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Operasi Dan Pemeliharaan', 'id_jabatan' => 'PGOP001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Program Anggaran Dan Pelaporan', 'id_jabatan' => 'PGPA001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Rencana Inspeksi Dan Verifikasi', 'id_jabatan' => 'PGRIV001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Rencana Kebutuhan Rumah Tangga Dan Perlengkapan', 'id_jabatan' => 'PGRRT001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Rencana Kebutuhan Sarana Dan Prasarana', 'id_jabatan' => 'PGRSAR001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Rencana Pengadaan Sarana Dan Prasarana', 'id_jabatan' => 'PGRPSR001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengelola Teknologi Informasi', 'id_jabatan' => 'PGTI001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengendali Pemadam Kebakaran', 'id_jabatan' => 'PGDPK001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengolah Bangunan Gedung', 'id_jabatan' => 'PNBG001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengolah Data', 'id_jabatan' => 'PGHD001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengolah Data Laporan Keuangan', 'id_jabatan' => 'PGD001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengolah Data Penelitian Dasar Dan Pengembangan Ilmu', 'id_jabatan' => 'PGDP001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengolah Kearsipan', 'id_jabatan' => 'PGHK001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengolah Kepegawaian', 'id_jabatan' => 'PGPEG001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengolah Kerasipan', 'id_jabatan' => 'PGAR001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengolah Program Dan Pelaporan', 'id_jabatan' => 'PGPP001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengurus Barang', 'id_jabatan' => 'PUB001', 'keterangan' => null],
            ['nama_jabatan' => 'Pengurus Barang Pembantu', 'id_jabatan' => 'PUB002', 'keterangan' => null],
            ['nama_jabatan' => 'Perencana Ahli Madya', 'id_jabatan' => 'PRAMY001', 'keterangan' => null],
            ['nama_jabatan' => 'Perencana Ahli Muda', 'id_jabatan' => 'PRAM001', 'keterangan' => null],
            ['nama_jabatan' => 'Perencana Ahli Muda(Ketua Subkelompok Program Dan Pelaporan)', 'id_jabatan' => 'PRAMKS001', 'keterangan' => null],
            ['nama_jabatan' => 'Perencana Ahli Pertama', 'id_jabatan' => 'PRAP001', 'keterangan' => null],
            ['nama_jabatan' => 'Petugas Informasi Dan Komunikasi Pemadam Kebakaran', 'id_jabatan' => 'PTIK001', 'keterangan' => null],
            ['nama_jabatan' => 'Petugas Penanggulangan Kebakaran Dan Rescue', 'id_jabatan' => 'PTPK001', 'keterangan' => null],
            ['nama_jabatan' => 'Petugas Unit Pemadam Kebakaran', 'id_jabatan' => 'PTUP001', 'keterangan' => null],
            ['nama_jabatan' => 'Pranata Hubungan Masyarakat Ahli Pertama', 'id_jabatan' => 'PNTHM001', 'keterangan' => null],
            ['nama_jabatan' => 'Pranata Komputer Ahli Pertama', 'id_jabatan' => 'PRKAP001', 'keterangan' => null],
            ['nama_jabatan' => 'Pustakawan Ahli Muda', 'id_jabatan' => 'PUSAM001', 'keterangan' => null],
            ['nama_jabatan' => 'Pustakawan Ahli Pertama', 'id_jabatan' => 'PUSAP001', 'keterangan' => null],
            ['nama_jabatan' => 'Sekretaris Dinas', 'id_jabatan' => 'SD001', 'keterangan' => null],
            ['nama_jabatan' => 'Verifikator Keuangan', 'id_jabatan' => 'VK001', 'keterangan' => null],


        ];

        foreach ($data_jabatan as $jabatan) {
            Jabatan::create($jabatan);
        }
    }
}
