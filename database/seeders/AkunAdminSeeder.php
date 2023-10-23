<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(['id' => 'adminbidops', 'nama_akun' => 'Bidang Operasi', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminjasinfo', 'nama_akun' => 'Bidang Kerjasama Dan Informasi', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsekretariat', 'nama_akun' => 'Sekretariat', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsuper', 'nama_akun' => 'Bidang Sarana Operasi', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admincegah', 'nama_akun' => 'Bidang Pencegahan Kebakaran', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsudin11', 'nama_akun' => 'Sudin Jakarta Pusat', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin1.11', 'nama_akun' => 'Sudin Jakarta Pusat Sektor Gambir', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin1.12', 'nama_akun' => 'Sudin Jakarta Pusat Sektor Sawah Besar', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin1.13', 'nama_akun' => 'Sudin Jakarta Pusat Sektor Kemayoran', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin1.14', 'nama_akun' => 'Sudin Jakarta Pusat Sektor Senen', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin1.15', 'nama_akun' => 'Sudin Jakarta Pusat Sektor Cempaka Putih', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin1.16', 'nama_akun' => 'Sudin Jakarta Pusat Sektor Menteng', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin1.17', 'nama_akun' => 'Sudin Jakarta Pusat Sektor Tanah Abang', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin1.18', 'nama_akun' => 'Sudin Jakarta Pusat Sektor Johar Baru', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubops11', 'nama_akun' => 'Sudin Jakarta Pusat Seksi Operasi', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubtu11', 'nama_akun' => 'Sudin Jakarta Pusat Subbagian Tata Usaha', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubcegah11', 'nama_akun' => 'Sudin Jakarta Pusat Seksi Pencegahan Kebakaran', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsudin21', 'nama_akun' => 'Sudin Jakarta Utara', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin2.11', 'nama_akun' => 'Sudin Jakarta Utara Sektor Penjaringan', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin2.12', 'nama_akun' => 'Sudin Jakarta Utara Sektor Tanjung Priok', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin2.13', 'nama_akun' => 'Sudin Jakarta Utara Sektor Koja', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin2.14', 'nama_akun' => 'Sudin Jakarta Utara Sektor Cilincing', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin2.15', 'nama_akun' => 'Sudin Jakarta Utara Sektor Pademangan', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin2.16', 'nama_akun' => 'Sudin Jakarta Utara Sektor Kelapa Gading', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin2.17', 'nama_akun' => 'Sudin Jakarta Utara Sektor Kepulauan Seribu Utara', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin2.18', 'nama_akun' => 'Sudin Jakarta Utara Sektor Kepulauan Seribu Selatan', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubops21', 'nama_akun' => 'Sudin Jakarta Utara Seksi Operasi', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubtu21', 'nama_akun' => 'Sudin Jakarta Utara Subbagian Tata Usaha', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubcegah21', 'nama_akun' => 'Sudin Jakarta Utara Seksi Pencegahan Kebakaran', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsudin31', 'nama_akun' => 'Sudin Jakarta Barat', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin3.11', 'nama_akun' => 'Sudin Jakarta Barat Sektor Cengkareng', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin3.12', 'nama_akun' => 'Sudin Jakarta Barat Sektor Grogol Petamburan', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin3.13', 'nama_akun' => 'Sudin Jakarta Barat Sektor Taman Sari', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin3.14', 'nama_akun' => 'Sudin Jakarta Barat Sektor Tambora', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin3.15', 'nama_akun' => 'Sudin Jakarta Barat Sektor Kebon Jeruk', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin3.16', 'nama_akun' => 'Sudin Jakarta Barat Sektor Kalideres', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin3.17', 'nama_akun' => 'Sudin Jakarta Barat Sektor Palmerah', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin3.18', 'nama_akun' => 'Sudin Jakarta Barat Sektor Kembangan', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubops31', 'nama_akun' => 'Sudin Jakarta Barat Seksi Operasi', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubtu31', 'nama_akun' => 'Sudin Jakarta Barat Subbagian Tata Usaha', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubcegah31', 'nama_akun' => 'Sudin Jakarta Barat Seksi Pencegahan Kebakaran', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubops41', 'nama_akun' => 'Sudin Jakarta Selatan Seksi Operasi', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsudin41', 'nama_akun' => 'Sudin Jakarta Selatan', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.11', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Tebet', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.12', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Setia Budi', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.13', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Mampang Prapatan', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.14', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Pasar Minggu', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.15', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Kebayoran Lama', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.16', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Cilandak', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.17', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Kebayoran Baru', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.18', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Pancoran', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.19', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Jagakarsa', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin4.20', 'nama_akun' => 'Sudin Jakarta Selatan Sektor Pesanggrahan', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubtu41', 'nama_akun' => 'Sudin Jakarta Selatan Subbagian Tata Usaha', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubcegah41', 'nama_akun' => 'Sudin Jakarta Selatan Seksi Pencegahan Kebakaran', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsudin51', 'nama_akun' => 'Sudin Jakarta Timur', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.11', 'nama_akun' => 'Sudin Jakarta Timur Sektor Matraman', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.12', 'nama_akun' => 'Sudin Jakarta Timur Sektor Pulo Gadung', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.13', 'nama_akun' => 'Sudin Jakarta Timur Sektor Jatinegara', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.14', 'nama_akun' => 'Sudin Jakarta Timur Sektor Kramat Jati', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.15', 'nama_akun' => 'Sudin Jakarta Timur Sektor Pasar Rebo', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.16', 'nama_akun' => 'Sudin Jakarta Timur Sektor Cakung', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.17', 'nama_akun' => 'Sudin Jakarta Timur Sektor Duren Sawit', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.18', 'nama_akun' => 'Sudin Jakarta Timur Sektor Makassar', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.19', 'nama_akun' => 'Sudin Jakarta Timur Sektor Ciracas', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'admin5.20', 'nama_akun' => 'Sudin Jakarta Timur Sektor Cipayung', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubops51', 'nama_akun' => 'Sudin Jakarta Timur Seksi Operasi', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubtu51', 'nama_akun' => 'Sudin Jakarta Timur Subbagian Tata Usaha', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminsubcegah51', 'nama_akun' => 'Sudin Jakarta Timur Seksi Pencegahan Kebakaran', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminpusdik', 'nama_akun' => 'Pusdiklatkar', 'password' => Hash::make('123456')]);
        Admin::create(['id' => 'adminlab', 'nama_akun' => 'Laboratorium', 'password' => Hash::make('123456')]);
    }
}
