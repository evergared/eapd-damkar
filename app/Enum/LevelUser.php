<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * Enum yang mempengaruhi hak akses user pegawai.
 * @method static self anggota()
 * @method static self danton()
 * @method static self kasudin()
 * @method static self adminSektor()
 * @method static self adminSudin()
 * @method static self adminDinas()
 */
class LevelUser extends Enum
{
    protected static function values():array
    {
        return [
            'anggota' => 'anggota',
            'danton' => 'danton',
            'kasudin' => 'kasudin',
            'adminSektor' => 'admin_sektor',
            'adminSudin' => 'admin_sudin',
            'adminDinas' =>'admin_dinas',
        ];
    }

    protected static function labels():array
    {
        return[
            'anggota' => 'Anggota',
            'danton' => 'Kepala Pleton',
            'kasudin' => 'Kepala Suku Dinas',
            'adminSektor' => 'Admin Sektor',
            'adminSudin' => 'Admin Sudin',
            'adminDinas' => 'Admin Dinas',
        ];
    }
}