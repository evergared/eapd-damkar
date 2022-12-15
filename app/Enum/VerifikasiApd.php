<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * @method static self input()
 * @method static self verifikasi()
 * @method static self terverifikasi()
 * @method static self tertolak()
 * @method static self mintaUpdate()
 */
class VerifikasiApd extends Enum
{
    protected static function values(): array
    {
        return [
            'input' => 1,
            'verifikasi' => 2,
            'terverifikasi' => 3,
            'tertolak' => 4,
            'mintaUpdate' => 5
        ];
    }

    protected static function labels(): array
    {
        return [
            'input' => 'Proses Input',
            'verifikasi' => 'Menunggu Verifikasi',
            'terverifikasi' => 'Telah Di Verif',
            'tertolak' => 'Verifikasi Ditolak',
            'mintaUpdate' => 'Proses Update'
        ];
    }
}
