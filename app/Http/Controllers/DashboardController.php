<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function tampilLogin($pesan = null)
    {
        $view = view('eapd.auth.login');

        return ($pesan ?? null) ? $view->with('pesan', $pesan) : $view;
    }

    public function tampilDashboardPegawai(Request $r)
    {
        return view("dashboard.pegawai");
    }
}
