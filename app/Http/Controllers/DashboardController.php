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

    public function tampilDashboardPegawai(Request $r)
    {

        // return dd(Auth::user()->data->jabatan->level_user);

        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
        {
            $adc = new ApdDataController;
            $periode = 1;
            // $periode = $adc->ambilIdPeriodeInput();

            $maks_inputan = 200;
            $value_inputan = 0;
            $value_tervalidasi = 4;

            $adc->hitungCapaianInputSektor(Auth::user()->data->sektor,$maks_inputan,$value_inputan,$periode);
            $adc->hitungCapaianInputSektor(Auth::user()->data->sektor,$maks_inputan,$value_tervalidasi,$periode,3);

            return view("eapd.dashboard.admin.main-sektor",[
                'maks_inputan' => $maks_inputan,
                'value_inputan' => $value_inputan,
                'value_tervalidasi' =>$value_tervalidasi
            ]);
        }
        else
            return view("eapd.dashboard.main-pegawai");
    }

    public function tampilProfil(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin.profil");
        else
            return view('eapd.dashboard.profil');
    }

    public function tampilRequestItem(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin.request-item");
        else
            return view('eapd.dashboard.request-item');
    }

    public function tampilApdKu(Request $r)
    {
        // return view('eapd.dashboard.apdku')->with('list_apd', $adc->bangunItemModalInputApd($adc->muatContohDaftarInputApd()[1]));
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin.apdku");
        else
            return view('eapd.dashboard.apdku');
    }

    public function tampilLaporan(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin.laporan");
        else
            return view('eapd.dashboard.main-pegawai');
    }
    public function tampilKepegawaian(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin.kepegawaian");
        else
            return view('eapd.dashboard.main-pegawai');
    }
}
