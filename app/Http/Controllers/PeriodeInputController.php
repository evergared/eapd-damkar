<?php

namespace App\Http\Controllers;

use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Illuminate\Http\Request;

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
