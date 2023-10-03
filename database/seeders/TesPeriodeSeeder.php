<?php

namespace Database\Seeders;

use App\Models\PeriodeInputApd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TesPeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PeriodeInputApd::create([
            "nama_periode" => "Test Periode",
            "tgl_awal" => "2023-09-01",
            "tgl_akhir" => "2024-01-01",
            "aktif"=> false,
            "kumpul_ukuran"=> true,
            "pesan_berjalan" => "Sekarang periode testing sedang berlangsung, coba cek sistem anda."
        ]);
    }
}
