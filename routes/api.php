<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FanController;
use App\Http\Controllers\Api\KlubController;
use App\Http\Controllers\Api\LigaController;
use App\Http\Controllers\Api\PemainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('liga', [LigaController::class, 'index']);
// Route::post('liga', [LigaController::class, 'store']);
// Route::get('liga/{id}', [LigaController::class, 'show']);
// Route::put('liga/{id}', [LigaController::class, 'update']);
// Route::delete('liga/{id}', [LigaController::class, 'destroy']);
// Route::resource('liga', LigaController::class)->except(['edit', 'create']);
// Route::resource('klub', KlubController::class)->except(['edit', 'create']);
// Route::resource('pemain', PemainController::class)->except(['edit', 'create']);
// Route::resource('fan', FanController::class)->except(['edit', 'create']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('liga', LigaController::class);
    Route::resource('klub', KlubController::class)->except(['edit', 'create']);
    Route::resource('pemain', PemainController::class)->except(['edit', 'create']);
    Route::resource('fan', FanController::class)->except(['edit', 'create']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
