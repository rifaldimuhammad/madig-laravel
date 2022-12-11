<?php

use App\Http\Controllers\bukuController;
use App\Http\Controllers\detailMagazineController;
use App\Http\Controllers\MagazineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::apiResource('/buku', BukuController::class);
Route::apiResource('/magazine', MagazineController::class);
Route::apiResource('/detail-magazine', detailMagazineController::class);
