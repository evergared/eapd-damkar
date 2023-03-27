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

require __DIR__ . '/auth.php';

Route::get('/', function () {

    if (Auth::check())
        return redirect()->route('dashboard');
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
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'tampilDashboardPegawai'])->name('dashboard');
    Route::get('/profil', [\App\Http\Controllers\DashboardController::class, 'tampilprofil'])->name('profil');
    Route::get('/request-item', [\App\Http\Controllers\DashboardController::class, 'tampilRequestItem'])->name('request-item');
    Route::get('/apdku', [\App\Http\Controllers\DashboardController::class, 'tampilApdKu'])->name('apdku');
    Route::get('/print-laporan', [\App\Http\Controllers\DashboardController::class, 'tampilPrintLaporan'])->name('print-laporan');
    Route::get('/progres-sektor', [\App\Http\Controllers\DashboardController::class, 'tampilProgresSektor'])->name('progres-sektor');
    Route::get('/kepegawaian', [\App\Http\Controllers\DashboardController::class, 'tampilKepegawaian'])->name('kepegawaian');
    Route::get('/ukuran', [\App\Http\Controllers\DashboardController::class, 'tampilUkuran'])->name('ukuran');
    Route::get('/data-ukuran', [\App\Http\Controllers\DashboardController::class, 'tampilDataUkuran'])->name('data-ukuran');
    Route::get('/data-distribusi', [\App\Http\Controllers\DashboardController::class, 'tampilDataDistribusi'])->name('data-distribusi');
    Route::get('/running-text', [\App\Http\Controllers\DashboardController::class, 'tampilRunningText'])->name('running-text');
});
