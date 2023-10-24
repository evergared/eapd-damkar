<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        // $this->call(TesMultiUploadSeeder::class);
        // $this->call(DummyDatabaseSeeder::class);
        // $this->call(TesPeriodeSeeder::class);
        // $this->call(PenempatanSeeder::class);
        // $this->call(JabatanSeeder::class);
        // $this->call(PegawaiSeeder::class);
        // $this->call(TesUserSeeder::class);
        $this->call(AkunAdminSeeder::class);
        // $this->call(TesJenisApdSeeder::class);
        // $this->call(TesBarangApdSeeder::class);
        // $this->call(TesTemplateApdSeeder::class);
    }
}
