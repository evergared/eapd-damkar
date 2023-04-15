<?php

namespace App\Http\Controllers;

use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Illuminate\Http\Request;

/**
 * Kelas yang mengatur periode input dan template input apd di periode tersebut.
 */
class PeriodeInputController extends Controller
{
    public function ambilIdPeriodeInput($tanggal = null)
    {
        if($tanggal == null)
            {
                return PeriodeInputApd::get()->first()->id;
            }
        // where tanggal awal < $tanggal < tanggal akhir -> value('id')
    }
}
