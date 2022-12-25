<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApdDataController;
use Illuminate\Support\Facades\Auth;

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
        $apd = new ApdDataController;
        $apd->bangunListInputApdDariTemplate('1');

        // return dd(Auth::user()->data->jabatan->level_user);

        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin.admin-main-pegawai");
        else
            return view("eapd.dashboard.main-pegawai");
    }

    public function tampilProfil(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin.admin-profil");
        else
            return view('eapd.dashboard.profil');
    }

    public function tampilRequestItem(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin.admin-request-item");
        else
            return view('eapd.dashboard.request-item');
    }

    public function tampilApdKu(Request $r)
    {
        $adc = new ApdDataController;
        // return view('eapd.dashboard.apdku')->with('list_apd', $adc->bangunItemModalInputApd($adc->muatContohDaftarInputApd()[1]));
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin.admin-apdku");
        else
            return view('eapd.dashboard.apdku');
    }
}
