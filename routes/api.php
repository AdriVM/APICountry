<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

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

// Ruta de la API para sacar los paises que reciba por el parámetro 'q'
Route::get('/countries/{q}', [CountryController::class, 'search'])->name('countries.search');
// Ruta de la API para sacar los países fronterizos que corresponden a los códigos de país recibidos.
Route::get('/borders/{codes}', [CountryController::class, 'border'])->name('countries.border');