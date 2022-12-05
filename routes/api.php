<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\TiketController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/tikets', [TiketController::class, 'index']);
Route::get('/lokasis', [LokasiController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/pesan', PesanController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    //khusus for admin
    Route::middleware('admin')->group(function () {
        Route::resource('/tiket', TiketController::class)->except('create', 'edit', 'show');
        Route::get('/tiket/{id}', [TiketController::class, 'show']);
        Route::resource('/lokasi', LokasiController::class)->except('create', 'edit', 'show');
        Route::get('/lokasi/{id}', [LokasiController::class, 'show']);
    });
});
