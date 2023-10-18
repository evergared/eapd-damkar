<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * @method static self belumTerima()
 * @method static self hilang()
 * @method static self baik()
 * @method static self rusakRingan()
 * @method static self rusakSedang()
 * @method static self rusakBerat()
 */
class StatusApd extends Enum
{
    protected static function values(): array
    {
        return [
            'belumTerima' => 'Belum Terima',
            'hilang' => 'Hilang',
            'baik' => 'baik',
            'rusakRingan' => 'rusak ringan',
            'rusakSedang' => 'rusak sedang',
            'rusakBerat' => 'rusak berat',
        ];
    }

    protected static function labels(): array
    {
        return [
            'belumTerima' => 'APD Belum Diterima',
            'hilang' => 'APD Hilang',
            'baik' => 'Kondisi Baik',
            'rusakRingan' => 'Rusak Ringan',
            'rusakSedang' => 'Rusak Sedang',
            'rusakBerat' => 'Rusak Berat',
        ];
    }
}
