<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;

class RegexController extends Controller
{
    public function ambilNomerSektor ($string_nama_sektor,$murni_angka = false, $opsi_penulisan_nomer = 'romawi')
    {
        try
        {
            $regex = "/";

            if(!$murni_angka)
                $regex = $regex."Sektor ";
        }
        catch(Throwable $e)
        {
            error_log('gagal mengambil nomer sektor');
            return "Sektor --";
        }
    }   
}
