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

    // @todo buat logic untuk generate thumbnail dari apd yang perlu diinput
    // @todo buat controller baru untuk menampung logic generate, kemungkinan akan dinamai ApdTemplateController
    public function tampilDashboardPegawai(Request $r)
    {
        return view("eapd.dashboard.main-pegawai");
    }

    public function tampilProfil(Request $r)
    {
        return view('eapd.dashboard.profil');
    }

    public function tampilRequestItem(Request $r)
    {
        return view('eapd.dashboard.request-item');
    }

    public function tampilApdKu(Request $r)
    {
        return view('eapd.dashboard.apdku');
    }
}
