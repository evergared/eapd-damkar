<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * Enum yang mendeskripsikan secara singkat tipe dari jabatan pegawai.
 * @method static self personil()
 * @method static self bengkel()
 * @method static self danton()
 * @method static self staff()
 * @method static self eselon4()
 */
class TipeJabatan extends Enum
{
    protected static function values():array
    {
        return [
            'personil' => 'personil',
            'bengkel' =>'bengkel',
            'danton' => 'danton',
            'staff' => 'staff',
            'eselon4' => 'eselon4',
        ];
    }

    protected static function labels():array
    {
        return[
            'personil' => 'Personil Lapangan',
            'bengkel' =>'Bengkel',
            'danton' => 'Danton',
            'staff' => 'Staff',
            'eselon4' => 'Eselon 4',
        ];
    }
}