<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\flutter\FlutterLoginController;
use App\Http\Controllers\flutter\FlutterRegisterController;
use App\Http\Controllers\flutter\FlutterBiodataController;
use App\Http\Controllers\KecamatanDesaController;
use App\Http\Controllers\flutter\AuthController;
use App\Http\Controllers\flutter\BerkasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login_flutter', [FlutterLoginController::class, 'login']);
Route::post('/register_flutter', [FlutterRegisterController::class, 'register']);

Route::get('/kecamatan', [KecamatanDesaController::class, 'getKecamatan']);
Route::get('/desa/{id_kec}', [KecamatanDesaController::class, 'getDesaByKecamatan']);
// Route::get('/biodata/{nik}', [FlutterBiodataController::class, 'index']);
Route::get('/berkas', [BerkasController::class, 'index']);
Route::get('/data-requests/{nik}', [BerkasController::class, 'show']);
Route::post('/send_request', [BerkasController::class, 'store']);
Route::put('/update-data/{id_request}', [BerkasController::class, 'update']);
Route::put('/update_biodata', [AuthController::class, 'update']);
Route::get('/riwayat/{nik}', [BerkasController::class, 'riwayat']);
Route::post('/login_flut', [AuthController::class, 'login']);
Route::get('/profile/{nik}', [FlutterLoginController::class, 'profile']);


// Route::get('/login', [LoginController::class, 'index'])->name('login');