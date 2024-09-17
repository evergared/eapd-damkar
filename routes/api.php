<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\InputDataApdController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// TODO : masukan ke dalam middleware sanctum
Route::post('/apd/input/index-list-input',[InputDataApdController::class,'indexHarusInput']);
Route::post('/apd/input/index-menu-input',[InputDataApdController::class,'showApdUntukInput']);
Route::post('/apd/input/show-apd-input',[InputDataApdController::class,'showApdTerinput']);
Route::post('/apd/input/show-apd-pegawai',[InputDataApdController::class,'showApdPegawai']);
Route::post('/apd/input/save-input',[InputDataApdController::class,'simpanApdInput']);
Route::post('/apd/input/update-input',[InputDataApdController::class,'updateApdInput']);
Route::post('/apd/input/delete-input',[InputDataApdController::class,'deleteApdTerinput']);


