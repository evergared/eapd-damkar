<?php

namespace Database\Factories\Eapd;

use App\Models\Eapd\ApdJenis;
use App\Models\Eapd\ApdKondisi;
use App\Models\Eapd\ApdList;
use App\Models\Eapd\ApdSize;
use App\Models\Eapd\PeriodeInputApd;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApdList>
 */
class ApdListFactory extends Factory
{
    protected $model = ApdList::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id_jenis = ApdJenis::all()->random()->id_jenis;
        $merk = $this->faker->word(2);
        $nama_apd = $this->faker->word(2);
        $id_size = (str_contains($id_jenis, 'B') ?? false) ? ApdSize::find(2)->id : ApdSize::find(1)->id;
        $id_kondisi = (str_contains($id_jenis, 'H') ?? false) ? ApdKondisi::find(2)->id : ApdKondisi::find(1)->id;
        $id = substr($id_jenis, 0, 1) . '-' . substr($merk, 0, 3);
        // error_log('id item : ' . $id);
        $jumlahApdSerupa = ApdList::where('id_apd', 'like', "'" . $id . "-%'")->count(); // sering error disini untuk men-generate id
        $id_apd = $id . '-' . str_pad($jumlahApdSerupa, 4, '0', STR_PAD_LEFT);

        return [
            'id_apd' => $id_apd,
            'nama_apd' => $nama_apd,
            'merk' => $merk,
            'id_jenis' => $id_jenis,
            'id_size' => $id_size,
            'id_kondisi' => $id_kondisi,
        ];
    }
}
