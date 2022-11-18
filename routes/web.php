<?php

use Illuminate\Support\Facades\Route;

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
});
