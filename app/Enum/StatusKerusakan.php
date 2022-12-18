<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * @method static self baik()
 * @method static self rusakRingan()
 * @method static self rusakSedang()
 * @method static self rusakBerat()
 */
class StatusKerusakan extends Enum
{
    protected static function values(): array
    {
        return [
            'baik' => 1,
            'rusakRingan' => 2,
            'rusakSedang' => 3,
            'rusakBerat' => 4,
        ];
    }

    protected static function labels(): array
    {
        return [
            'baik' => 'Baik',
            'rusakRingan' => 'Rusak Ringan',
            'rusakSedang' => 'Rusak Sedang',
            'rusakBerat' => 'Rusak Berat',
        ];
    }
}
