<?php

namespace Database\Factories\Eapd;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penempatan>
 */
class PenempatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
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
    }
}
