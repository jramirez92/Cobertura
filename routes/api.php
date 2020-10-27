<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('empalme', \App\Http\Controllers\API\EmpalmeController::class);

Route::apiResource('distribucion', \App\Http\Controllers\DistribucionController::class);

Route::post('callejero', [\App\Http\Controllers\API\CallejeroController::class, 'update']);

Route::get('callejero/encode', [\App\Http\Controllers\API\CallejeroController::class, 'encode']);

Route::put('indirecta', [\App\Http\Controllers\Api\IndirectaController::class, 'updateAll']);


