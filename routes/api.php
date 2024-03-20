<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReservaController;


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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/storeReservas', [ReservaController::class, 'store']);
    // Agrega aquí cualquier otra ruta que requiera protección
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
