<?php

namespace Database\Factories\Eapd;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Eapd\Jabatan;
use App\Models\Eapd\Wilayah;
use App\Models\Eapd\Penempatan;
use App\Models\Eapd\Grup;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $id_jabatan = Jabatan::all()->random()->id_jabatan;
        $id_wilayah = Wilayah::all()->random()->id_wilayah;
        $id_penempatan = Penempatan::all()->random()->id_penempatan;
        $id_grup = Grup::all()->random()->id_grup;

        return [
            'nrk' => $this->faker->numerify('########'),
            'nip' => $this->faker->numerify('################'),
            'nama' => $this->faker->name(),
            'no_telp' => $this->faker->phoneNumber(),
            'id_jabatan' => $id_jabatan,
            'id_wilayah' => $id_wilayah,
            'id_penempatan' => $id_penempatan,
            'id_grup' => $id_grup,
        ];
    }
}
