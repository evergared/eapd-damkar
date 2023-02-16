<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * @method static self belumTerima()
 * @method static self hilang()
 * @method static self ada()
 */
class KeberadaanApd extends Enum
{
    protected static function values(): array
    {
        return [
            'belumTerima' => 'belum terima',
            'hilang' => 'hilang',
            'ada' => 'ada',
        ];
    }

    protected static function labels(): array
    {
        return [
            'belumTerima' => 'APD Belum Diterima',
            'hilang' => 'APD Hilang',
            'ada' => 'Ada',
        ];
    }
}
