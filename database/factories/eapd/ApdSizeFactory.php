<?php

namespace Database\Factories\Eapd;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApdSize>
 */
class ApdSizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sizeUmum = [
            'XL',
            'L',
            'M',
            'S'
        ];

        $sizeSepatu = [
            '38',
            '39',
            '40',
            '41',
            '42',
            '43',
            '44',
            '45',
        ];

        return [
            ['nama_size' => 'umum', 'opsi' => $sizeUmum],
            ['nama_size' => 'sepatu', 'opsi' => $sizeSepatu],
        ];
    }
}
