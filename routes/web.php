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
    Route::get('/request-item', [\App\Http\Controllers\DashboardController::class, 'tampilRequestItem'])->name('request-item');
    Route::get('/print-laporan', [\App\Http\Controllers\DashboardController::class, 'tampilPrintLaporan'])->name('print-laporan');
    Route::get('/laporan-progress-input', [\App\Http\Controllers\DashboardController::class, 'tampilProgresSektor'])->name('progres-sektor');
    Route::get('/kepegawaian', [\App\Http\Controllers\DashboardController::class, 'tampilKepegawaian'])->name('kepegawaian');
    Route::get('/data-ukuran', [\App\Http\Controllers\DashboardController::class, 'tampilDataUkuran'])->name('data-ukuran');
    Route::get('/data-distribusi', [\App\Http\Controllers\DashboardController::class, 'tampilDataDistribusi'])->name('data-distribusi');
    Route::get('/periode-setting', [\App\Http\Controllers\DashboardController::class, 'tampilPeriodeSetting'])->name('periode-setting');
    Route::get('/pengaturan-barang', [\App\Http\Controllers\DashboardController::class, 'tampilPengaturanBarang'])->name('pengaturan-barang');
});

Route::middleware('auth:admin')->group(function () {

    Route::get('/superuser', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->to('/superuser/home');
        } else {
            return redirect()->to('/')->with('alert-warning', 'Silahkan login kembali menggunakan akun admin untuk mengakses dashboard admin.');
        }
    });

    Route::get('/superuser/home', \App\Http\Livewire\Dashboards\Admin\Home\Page::class)->name('dashboardAdmin');
    Route::get('/superuser/apd', \App\Http\Livewire\Dashboards\Admin\Data\Apd\Page::class)->name('dataApdAdmin');
    Route::get('/superuser/ukuran', \App\Http\Livewire\Dashboards\Admin\Data\Ukuran\Page::class)->name('dataUkuranAdmin');
    Route::get('/superuser/item', \App\Http\Livewire\Dashboards\Admin\ItemSetting\Page::class)->name('itemAdmin');
    Route::get('/superuser/kepegawaian', \App\Http\Livewire\Dashboards\Admin\Kepegawaian\Page::class)->name('kepegawaianAdmin');
    Route::get('/superuser/periode', \App\Http\Livewire\Dashboards\Admin\PeriodeSetting\Page::class)->name('periodeAdmin');
    Route::get('/superuser/user', \App\Http\Livewire\Dashboards\Admin\User\Page::class)->name('userAdmin');
});

Auth::routes();
