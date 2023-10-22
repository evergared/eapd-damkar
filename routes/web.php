<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// require __DIR__ . '/auth.php';

Route::get('/', function () {

    if (Auth::guard('web')->check())
        return redirect()->route('dashboard');

    if (Auth::guard('admin')->check())
        return redirect()->to('/superuser/home');

    return view('eapd/halaman-depan');
    // return view('tes/welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/tes/dashboard', function () {
        return view('tes/dashboard');
    });

    Route::get('/tes/multi-upload', function () {
        return view('tes/multi');
    })->name('multi');

    // Halaman Dashboard
    Route::get('/dashboard', \App\Http\Livewire\Dashboards\Pegawai\Home\Page::class)->name('dashboard');

    Route::get('/profil', \App\Http\Livewire\Dashboards\Pegawai\Profil\Page::class)->name('profil');
    Route::get('/apdku', \App\Http\Livewire\Dashboards\Pegawai\Apdku\Page::class)->name('apdku');
    Route::get('/ukuranku', \App\Http\Livewire\Dashboards\Pegawai\Ukuranku\Page::class)->name('ukuran');

    Route::get('/bantuan-barang/ganti-barang', \App\Http\Livewire\Dashboards\Pegawai\BantuanBarang\GantiBarang\Page::class)->name('ganti-barang');
    Route::get('/bantuan-barang/lapor-hilang', \App\Http\Livewire\Dashboards\Pegawai\BantuanBarang\LaporHilang\Page::class)->name('lapor-hilang');
    
    Route::get('/progress-anggota/pelaporan-apd', \App\Http\Livewire\Dashboards\Pegawai\Progress\Apd\Page::class)->name('progress-apd');
    Route::get('/progress-anggota/pelaporan-ukuran', \App\Http\Livewire\Dashboards\Pegawai\Progress\Ukuran\Page::class)->name('progress-ukuran');
    Route::get('/data-anggota/inputan-apd', \App\Http\Livewire\Dashboards\Pegawai\Data\Apd\Page::class)->name('data-apd');
    Route::get('/data-anggota/inputan-ukuran', \App\Http\Livewire\Dashboards\Pegawai\Data\Ukuran\Page::class)->name('data-ukuran');

    Route::get('/request-item', [\App\Http\Controllers\DashboardController::class, 'tampilRequestItem'])->name('request-item');

});

Route::middleware('auth:admin')->group(function () {

    Route::get('/superuser', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->to('/superuser/home');
        } else {
            return redirect()->to('/')->with('alert-warning', 'Silahkan login kembali menggunakan akun admin untuk mengakses dashboard admin.');
        }
    });

    Route::get('/superuser/home', \App\Http\Livewire\Dashboards\Admin\Home\Page::class)->name('admin-dashboard');
    Route::get('/superuser/profil', \App\Http\Livewire\Dashboards\Admin\Profil\Page::class)->name('admin-profil');

    Route::get('/superuser/aduan-barang', \App\Http\Livewire\Dashboards\Admin\AduanBarang\Page::class)->name('admin-aduan-barang');

    Route::get('/superuser/progress-inputan/apd', \App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd\Page::class)->name('admin-progress-apd');
    Route::get('/superuser/progress-inputan/ukuran', \App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Ukuran\Page::class)->name('admin-progress-ukuran');

    Route::get('/superuser/ubah-data-terverifikasi', \App\Http\Livewire\Dashboards\Admin\PermintaanUbahData\Page::class)->name('admin-ubah-data-terverifikasi');

    Route::get('/superuser/data-apd/inputan-anggota', \App\Http\Livewire\Dashboards\Admin\DataApd\Inputan\Page::class)->name('admin-data-apd-inputan');
    Route::get('/superuser/data-apd/list-no_seri', \App\Http\Livewire\Dashboards\Admin\DataApd\NoSeri\Page::class)->name('admin-data-apd-no_seri');
    Route::get('/superuser/data-apd/pensiunan', \App\Http\Livewire\Dashboards\Admin\DataApd\Pensiunan\Page::class)->name('admin-data-apd-pensiunan');
    Route::get('/superuser/data-apd/rekapitulasi', \App\Http\Livewire\Dashboards\Admin\DataApd\Rekapitulasi\Page::class)->name('admin-data-apd-rekap');

    Route::get('/superuser/data-ukuran/ukuran-anggota', \App\Http\Livewire\Dashboards\Admin\DataUkuran\ListUkuran\Page::class)->name('admin-data-ukuran-inputan');
    Route::get('/superuser/data-ukuran/rekapitulasi', \App\Http\Livewire\Dashboards\Admin\DataUkuran\Rekapitulasi\Page::class)->name('admin-data-ukuran-rekap');
    
    Route::get('/superuser/pengaturan/barang-apd', \App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd\Page::class)->name('admin-pengaturan-apd-barang');
    Route::get('/superuser/pengaturan/jenis-apd', \App\Http\Livewire\Dashboards\Admin\PengaturanBarang\JenisBarang\Page::class)->name('admin-pengaturan-jenis-barang');

    Route::get('/superuser/pengaturan/kepegawaian', \App\Http\Livewire\Dashboards\Admin\Kepegawaian\Page::class)->name('admin-pengaturan-kepegawaian');
    Route::get('/superuser/pengaturan/periode', \App\Http\Livewire\Dashboards\Admin\PengaturanPeriode\Page::class)->name('admin-pengaturan-periode');
    Route::get('/superuser/pengaturan/akun-user', \App\Http\Livewire\Dashboards\Admin\User\Page::class)->name('admin-pengaturan-user');
});

Auth::routes();
