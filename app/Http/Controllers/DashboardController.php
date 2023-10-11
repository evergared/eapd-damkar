<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApdDataController;
use Illuminate\Support\Facades\Auth;

/**
 * Kontroler yang menghandle request dan penyajian halaman web.
 */
class DashboardController extends Controller
{


    public function tampilLogin($pesan = null)
    {
        $view = view('eapd.auth.login');

        return ($pesan ?? null) ? $view->with('pesan', $pesan) : $view;
    }

    public function tampilDashboardPegawai(Request $r)
    {

        // $arc = new ApdRekapController;

        // // return dd($arc->bangunDataTabelRekapSektor());
        // // return dd(Auth::user()->data->jabatan->level_user);
        // if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
        //     return view("eapd.dashboard.admin-sektor.main-sektor");
        // else if (Auth::user()->data->jabatan->level_user == 'admin_sudin')
        //     return view("eapd.dashboard.admin-sudin.main-sudin");
        // else if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
        //     return view("eapd.dashboard.admin-dinas.main-dinas");
        // else
        return view('dashboards.pegawai.home');
    }

    public function tampilProfil(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin-sektor.profil");
        else if (Auth::user()->data->jabatan->level_user == 'admin_sudin')
            return view("eapd.dashboard.admin-sudin.profil");
        else if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
            return view("eapd.dashboard.admin-dinas.profil");
        else
            return view('eapd.dashboard.halaman-pegawai.profil');
    }

    public function tampilRequestItem(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin-sektor.request-item");
        else if (Auth::user()->data->jabatan->level_user == 'admin_sudin')
            return view("eapd.dashboard.admin-sudin.request-item");
        else if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
            return view("eapd.dashboard.admin-dinas.request-item");
        else
            return view('eapd.dashboard.halaman-pegawai.request-item');
    }

    public function tampilUkuran(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin-sektor.ukuran");
        else if (Auth::user()->data->jabatan->level_user == 'admin_sudin')
            return view("eapd.dashboard.admin-sudin.ukuran");
        else if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
            return view("eapd.dashboard.admin-dinas.ukuran");
        else
            return view('eapd.dashboard.halaman-pegawai.ukuran');
    }

    public function tampilApdKu(Request $r)
    {
        // return view('eapd.dashboard.apdku')->with('list_apd', $adc->bangunItemModalInputApd($adc->muatContohDaftarInputApd()[1]));
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin-sektor.apdku");
        else if (Auth::user()->data->jabatan->level_user == 'admin_sudin')
            return view("eapd.dashboard.admin-sudin.apdku");
        else if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
            return view("eapd.dashboard.admin-dinas.apdku");
        else
            return view('eapd.dashboard.halaman-pegawai.apdku');
    }

    public function tampilPrintLaporan(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin-sektor.print-laporan");
        else if (Auth::user()->data->jabatan->level_user == 'admin_sudin')
            return view("eapd.dashboard.admin-sudin.print-laporan");
        else if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
            return view("eapd.dashboard.admin-dinas.print-laporan");
        else
            return view('eapd.dashboard.halaman-pegawai.main-pegawai');
    }

    public function tampilDataUkuran(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin-sektor.data-ukuran");
        else if (Auth::user()->data->jabatan->level_user == 'admin_sudin')
            return view("eapd.dashboard.admin-sudin.data-ukuran");
        else if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
            return view("eapd.dashboard.admin-dinas.data-ukuran");
        else
            return view('eapd.dashboard.halaman-pegawai.main-pegawai');
    }

    public function tampilDataDistribusi(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin-sektor.data-distribusi");
        else if (Auth::user()->data->jabatan->level_user == 'admin_sudin')
            return view("eapd.dashboard.admin-sudin.data-distribusi");
        else if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
            return view("eapd.dashboard.admin-dinas.data-distribusi");
        else
            return view('eapd.dashboard.halaman-pegawai.main-pegawai');
    }

    public function tampilProgresSektor(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor') {
            $adc = new ApdDataController;
            $periode = 1;
            // $periode = $adc->ambilIdPeriodeInput();

            $maks_inputan = 200;
            $value_inputan = 0;
            $value_tervalidasi = 4;

            $adc->hitungCapaianInputSektor(Auth::user()->data->sektor, $maks_inputan, $value_inputan, $periode);
            $adc->hitungCapaianInputSektor(Auth::user()->data->sektor, $maks_inputan, $value_tervalidasi, $periode, 3);

            return view("eapd.dashboard.admin-sektor.progres-sektor", [
                'maks_inputan' => $maks_inputan,
                'value_inputan' => $value_inputan,
                'value_tervalidasi' => $value_tervalidasi
            ]);
        } else if (Auth::user()->data->jabatan->level_user == 'admin_sudin') {
            return view("eapd.dashboard.admin-sudin.progres-sektor");
        } else if (Auth::user()->data->jabatan->level_user == 'admin_dinas') {
            return view("eapd.dashboard.admin-dinas.progres-dinas");
        } else
            return view("eapd.dashboard.halaman-pegawai.main-pegawai");
    }

    public function tampilKepegawaian(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_sektor')
            return view("eapd.dashboard.admin-sektor.kepegawaian");
        else if (Auth::user()->data->jabatan->level_user == 'admin_sudin')
            return view("eapd.dashboard.admin-sudin.kepegawaian");
        else if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
            return view("eapd.dashboard.admin-dinas.kepegawaian");
        else
            return view('eapd.dashboard.halaman-pegawai.main-pegawai');
    }

    public function tampilPeriodeSetting(Request $r)
    {
        return view("eapd.dashboard.admin-dinas.periode-setting");
    }

    public function tampilPengaturanBarang(Request $r)
    {
        if (Auth::user()->data->jabatan->level_user == 'admin_dinas')
            return view("eapd.dashboard.admin-dinas.pengaturan-barang");

        else
            return view('eapd.dashboard.halaman-pegawai.main-pegawai');
    }
}
