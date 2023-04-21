<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/ads-store', [ApiController::class,'adsStore'])->name('adsStore');
Route::get('/get-states', [ApiController::class,'getStates'])->name('getStates');
Route::get('/get-localities/{id}', [ApiController::class,'getLocalities'])->name('getLocalities');
Route::get('/get-htypes', [ApiController::class,'getHtypes'])->name('getHtypes');