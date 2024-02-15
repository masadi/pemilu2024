<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\KegiatanController;
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
Route::get('qr-code', [ScanController::class, 'get_qrcode'])->name('get_qrcode');
Route::group(['prefix' => 'auth'], function () {
  Route::post('login', [AuthController::class, 'login'])->name('login');
  Route::post('register', [AuthController::class, 'register']);
  Route::post('daftar', [TokenController::class, 'register']);
  Route::post('token', [TokenController::class, 'store']);
  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::delete('token/delete', [TokenController::class, 'destroy']);
    Route::post('imageadd', [TokenController::class, 'imageadd']);
    Route::post('update-data', [TokenController::class, 'update_data']);
  });
});
Route::group(['middleware' => 'auth:sanctum'], function() {
  Route::get('rekapitulasi', [RekapController::class, 'index']);
  Route::post('scan', [ScanController::class, 'index']);
  Route::group(['prefix' => 'kegiatan'], function () {
    Route::get('osis', [KegiatanController::class, 'osis']);
    Route::get('sekolah', [KegiatanController::class, 'sekolah']);
  });
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
