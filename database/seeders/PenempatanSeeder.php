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
            ['id_wilayah' => '0', 'nama_wilayah' => 'Kantor Dinas', 'keterangan' => null],
            ['id_wilayah' => '1', 'nama_wilayah' => 'Jakarta Pusat', 'keterangan' => null],
            ['id_wilayah' => '2', 'nama_wilayah' => 'Jakarta Utara', 'keterangan' => null],
            ['id_wilayah' => '3', 'nama_wilayah' => 'Jakarta Barat', 'keterangan' => null],
            ['id_wilayah' => '4', 'nama_wilayah' => 'Jakarta Selatan', 'keterangan' => null],
            ['id_wilayah' => '5', 'nama_wilayah' => 'Jakarta Timur', 'keterangan' => null],
            ['id_wilayah' => '7', 'nama_wilayah' => 'Pusdiklatkar', 'keterangan' => null],
            ['id_wilayah' => '8', 'nama_wilayah' => 'Laboraturium', 'keterangan' => null],
        ];

        $data_penempatan = [
            ['id_penempatan' => '0.4', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Bidang Operasi', 'id_wilayah' => '0', 'tipe' => 'bidops'],
            ['id_penempatan' => '0.4.1', 'id_parent_penempatan' => '0.4', 'nama_penempatan' => 'Seksi Operasi Kebakaran', 'id_wilayah' => '0', 'tipe' => 'bidops'],
            ['id_penempatan' => '0.4.2', 'id_parent_penempatan' => '0.4', 'nama_penempatan' => 'Seksi Operasi Penyelamatan', 'id_wilayah' => '0', 'tipe' => 'bidops'],
            ['id_penempatan' => '0.4.3', 'id_parent_penempatan' => '0.4', 'nama_penempatan' => 'Subkelompok Pengendalian Operasi', 'id_wilayah' => '0', 'tipe' => 'bidops'],
            ['id_penempatan' => '0.5', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Bidang Kerjasama Dan Informasi', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.5.1', 'id_parent_penempatan' => '0.5', 'nama_penempatan' => 'Seksi Kerjasama Dan Kehumasan', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.5.2', 'id_parent_penempatan' => '0.5', 'nama_penempatan' => 'Bidang Kerjasama Dan InformasiSeksi Data Dan Informasi', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.5.3', 'id_parent_penempatan' => '0.5', 'nama_penempatan' => 'Subkelompok Sistem Informasi', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.6', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Sekretariat', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.6.1', 'id_parent_penempatan' => '0.6', 'nama_penempatan' => 'Sekretariat Subbagian Umum', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.6.2', 'id_parent_penempatan' => '0.6', 'nama_penempatan' => 'Sekretariat Subbagian Keuangan', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.6.3', 'id_parent_penempatan' => '0.6', 'nama_penempatan' => 'Sekretariat Subkelompok Kepegawaian', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.6.4', 'id_parent_penempatan' => '0.6', 'nama_penempatan' => 'Sekretariat Subkelompok Program dan Pelaporan', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.7', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Bidang Sarana Operasi', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.7.1', 'id_parent_penempatan' => '0.7', 'nama_penempatan' => 'Bidang Sarana Operasi Seksi Perencanaan Sarana', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.7.2', 'id_parent_penempatan' => '0.7', 'nama_penempatan' => 'Bidang Sarana Operasi Seksi Penyediaan Dan Pemanfaatan', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.7.3', 'id_parent_penempatan' => '0.7', 'nama_penempatan' => 'Bidang Sarana Operasi Seksi Pemeliharaan', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.8', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Bidang Pencegahan Kebakaran', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.8.1', 'id_parent_penempatan' => '0.8', 'nama_penempatan' => 'Bidang Pencegahan Kebakaran Seksi Pembinaan Teknis', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.8.2', 'id_parent_penempatan' => '0.8', 'nama_penempatan' => 'Bidang Pencegahan Kebakaran Seksi Pemberdayaan Masyarakat', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '0.8.3', 'id_parent_penempatan' => '0.8', 'nama_penempatan' => 'Bidang Pencegahan Kebakaran Subkelompok Pengawasan Keselamatan Kebakaran', 'id_wilayah' => '0', 'tipe' => 'dinas'],
            ['id_penempatan' => '1.1', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Sudin Jakarta Pusat', 'id_wilayah' => '1', 'tipe' => 'sudin'],
            ['id_penempatan' => '1.11', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Sektor Gambir', 'id_wilayah' => '1', 'tipe' => 'sektor'],
            ['id_penempatan' => '1.12', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Sektor Sawah Besar', 'id_wilayah' => '1', 'tipe' => 'sektor'],
            ['id_penempatan' => '1.13', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Sektor Kemayoran', 'id_wilayah' => '1', 'tipe' => 'sektor'],
            ['id_penempatan' => '1.14', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Sektor Senen', 'id_wilayah' => '1', 'tipe' => 'sektor'],
            ['id_penempatan' => '1.15', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Sektor Cempaka Putih', 'id_wilayah' => '1', 'tipe' => 'sektor'],
            ['id_penempatan' => '1.16', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Sektor Menteng', 'id_wilayah' => '1', 'tipe' => 'sektor'],
            ['id_penempatan' => '1.17', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Sektor Tanah Abang', 'id_wilayah' => '1', 'tipe' => 'sektor'],
            ['id_penempatan' => '1.18', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Sektor Johar Baru', 'id_wilayah' => '1', 'tipe' => 'sektor'],
            ['id_penempatan' => '1.4', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Seksi Operasi', 'id_wilayah' => '1', 'tipe' => 'subcc'],
            ['id_penempatan' => '1.6', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Subbagian Tata Usaha', 'id_wilayah' => '1', 'tipe' => 'sudin'],
            ['id_penempatan' => '1.7', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Seksi Sarana Operasi', 'id_wilayah' => '1', 'tipe' => 'sudin'],
            ['id_penempatan' => '1.8', 'id_parent_penempatan' => '1.1', 'nama_penempatan' => 'Sudin Jakarta Pusat Seksi Pencegahan Kebakaran', 'id_wilayah' => '1', 'tipe' => 'sudin'],
            ['id_penempatan' => '2.1', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Sudin Jakarta Utara', 'id_wilayah' => '2', 'tipe' => 'sudin'],
            ['id_penempatan' => '2.11', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Sektor Penjaringan', 'id_wilayah' => '2', 'tipe' => 'sektor'],
            ['id_penempatan' => '2.12', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Sektor Tanjung Priok', 'id_wilayah' => '2', 'tipe' => 'sektor'],
            ['id_penempatan' => '2.13', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Sektor Koja', 'id_wilayah' => '2', 'tipe' => 'sektor'],
            ['id_penempatan' => '2.14', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Sektor Cilincing', 'id_wilayah' => '2', 'tipe' => 'sektor'],
            ['id_penempatan' => '2.15', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Sektor Pademangan', 'id_wilayah' => '2', 'tipe' => 'sektor'],
            ['id_penempatan' => '2.16', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Sektor Kelapa Gading', 'id_wilayah' => '2', 'tipe' => 'sektor'],
            ['id_penempatan' => '2.17', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Sektor Kepulauan Seribu Utara', 'id_wilayah' => '2', 'tipe' => 'sektor'],
            ['id_penempatan' => '2.18', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Sektor Kepulauan Seribu Selatan', 'id_wilayah' => '2', 'tipe' => 'sektor'],
            ['id_penempatan' => '2.4', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Seksi Operasi', 'id_wilayah' => '2', 'tipe' => 'subcc'],
            ['id_penempatan' => '2.6', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Subbagian Tata Usaha', 'id_wilayah' => '2', 'tipe' => 'sudin'],
            ['id_penempatan' => '2.7', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Seksi Sarana Operasi', 'id_wilayah' => '2', 'tipe' => 'sudin'],
            ['id_penempatan' => '2.8', 'id_parent_penempatan' => '2.1', 'nama_penempatan' => 'Sudin Jakarta Utara Seksi Pencegahan Kebakaran', 'id_wilayah' => '2', 'tipe' => 'sudin'],
            ['id_penempatan' => '3.1', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Sudin Jakarta Barat', 'id_wilayah' => '3', 'tipe' => 'sudin'],
            ['id_penempatan' => '3.11', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Sektor Cengkareng', 'id_wilayah' => '3', 'tipe' => 'sektor'],
            ['id_penempatan' => '3.12', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Sektor Grogol Petamburan', 'id_wilayah' => '3', 'tipe' => 'sektor'],
            ['id_penempatan' => '3.13', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Sektor Taman Sari', 'id_wilayah' => '3', 'tipe' => 'sektor'],
            ['id_penempatan' => '3.14', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Sektor Tambora', 'id_wilayah' => '3', 'tipe' => 'sektor'],
            ['id_penempatan' => '3.15', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Sektor Kebon Jeruk', 'id_wilayah' => '3', 'tipe' => 'sektor'],
            ['id_penempatan' => '3.16', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Sektor Kalideres', 'id_wilayah' => '3', 'tipe' => 'sektor'],
            ['id_penempatan' => '3.17', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Sektor Palmerah', 'id_wilayah' => '3', 'tipe' => 'sektor'],
            ['id_penempatan' => '3.18', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Sektor Kembangan', 'id_wilayah' => '3', 'tipe' => 'sektor'],
            ['id_penempatan' => '3.4', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Seksi Operasi', 'id_wilayah' => '3', 'tipe' => 'sudin'],
            ['id_penempatan' => '3.6', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Subbagian Tata Usaha', 'id_wilayah' => '3', 'tipe' => 'sudin'],
            ['id_penempatan' => '3.7', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Seksi Sarana Operasi', 'id_wilayah' => '3', 'tipe' => 'sudin'],
            ['id_penempatan' => '3.8', 'id_parent_penempatan' => '3.1', 'nama_penempatan' => 'Sudin Jakarta Barat Seksi Pencegahan Kebakaran', 'id_wilayah' => '3', 'tipe' => 'sudin'],

            ['id_penempatan' => '4.1', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Sudin Jakarta Selatan', 'id_wilayah' => '4', 'tipe' => 'sudin'],
            ['id_penempatan' => '4.4', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Seksi Operasi', 'id_wilayah' => '4', 'tipe' => 'subcc'],
            ['id_penempatan' => '4.11', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Tebet', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.12', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Setia Budi', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.13', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Mampang Prapatan', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.14', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Pasar Minggu', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.15', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Kebayoran Lama', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.16', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Cilandak', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.17', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Kebayoran Baru', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.18', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Pancoran', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.19', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Jagakarsa', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.20', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Sektor Pesanggrahan', 'id_wilayah' => '4', 'tipe' => 'sektor'],
            ['id_penempatan' => '4.6', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Subbagian Tata Usaha', 'id_wilayah' => '4', 'tipe' => 'sudin'],
            ['id_penempatan' => '4.7', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Seksi Sarana Operasi', 'id_wilayah' => '4', 'tipe' => 'sudin'],
            ['id_penempatan' => '4.8', 'id_parent_penempatan' => '4.1', 'nama_penempatan' => 'Sudin Jakarta Selatan Seksi Pencegahan Kebakaran', 'id_wilayah' => '4', 'tipe' => 'sudin'],
            ['id_penempatan' => '5.1', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Sudin Jakarta Timur', 'id_wilayah' => '5', 'tipe' => 'sudin'],
            ['id_penempatan' => '5.11', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Matraman', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.12', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Pulo Gadung', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.13', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Jatinegara', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.14', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Kramat Jati', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.15', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Pasar Rebo', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.16', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Cakung', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.17', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Duren Sawit', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.18', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Makassar', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.19', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Ciracas', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.20', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Sektor Cipayung', 'id_wilayah' => '5', 'tipe' => 'sektor'],
            ['id_penempatan' => '5.4', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Seksi Operasi', 'id_wilayah' => '5', 'tipe' => 'subcc'],
            ['id_penempatan' => '5.6', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Subbagian Tata Usaha', 'id_wilayah' => '5', 'tipe' => 'sudin'],
            ['id_penempatan' => '5.7', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Seksi Sarana Operasi', 'id_wilayah' => '5', 'tipe' => 'sudin'],
            ['id_penempatan' => '5.8', 'id_parent_penempatan' => '5.1', 'nama_penempatan' => 'Sudin Jakarta Timur Seksi Pencegahan Kebakaran', 'id_wilayah' => '5', 'tipe' => 'sudin'],
            ['id_penempatan' => '7.1', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Pusdiklatkar', 'id_wilayah' => '7', 'tipe' => 'diklat'],
            ['id_penempatan' => '7.1.1', 'id_parent_penempatan' => '7.1', 'nama_penempatan' => 'Pusdiklatkar Subbagian Tata Usaha', 'id_wilayah' => '7', 'tipe' => 'diklat'],
            ['id_penempatan' => '7.1.7.1', 'id_parent_penempatan' => '7.1', 'nama_penempatan' => 'Pusdiklatkar Satuan Pelaksana Pendidikan dan Pelatihan', 'id_wilayah' => '7', 'tipe' => 'diklat'],
            ['id_penempatan' => '7.1.7.2', 'id_parent_penempatan' => '7.1', 'nama_penempatan' => 'Pusdiklatkar Satuan Pelaksana Pengembangan Pendidikan dan Pelatihan', 'id_wilayah' => '7', 'tipe' => 'diklat'],
            ['id_penempatan' => '7.1.7.3', 'id_parent_penempatan' => '7.1', 'nama_penempatan' => 'Pusdiklatkar Satuan Pelaksana Prasarana dan Sarana', 'id_wilayah' => '7', 'tipe' => 'diklat'],
            ['id_penempatan' => '8.1', 'id_parent_penempatan' => null, 'nama_penempatan' => 'Laboratorium', 'id_wilayah' => '8', 'tipe' => 'lab'],
            ['id_penempatan' => '8.1.1', 'id_parent_penempatan' => '8.1', 'nama_penempatan' => 'Laboratorium Subbagian Tata Usaha', 'id_wilayah' => '8', 'tipe' => 'lab'],
            ['id_penempatan' => '8.1.8.1', 'id_parent_penempatan' => '8.1', 'nama_penempatan' => 'Laboratorium Satuan Pelaksana Pengujian Mutu', 'id_wilayah' => '8', 'tipe' => 'lab'],
            ['id_penempatan' => '8.1.8.2', 'id_parent_penempatan' => '8.1', 'nama_penempatan' => 'Laboratorium Satuan Pelaksana Investigasi Kebakaran', 'id_wilayah' => '8', 'tipe' => 'lab'],





        ];

        foreach ($data_wilayah as $wilayah) {
            Wilayah::create($wilayah);
        }

        foreach ($data_penempatan as $penempatan) {
            Penempatan::create($penempatan);
        }
    }
}
