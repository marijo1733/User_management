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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::get('index', [\App\Http\Controllers\AuthController::class, 'index']);
    Route::get('show/{user}', [\App\Http\Controllers\AuthController::class, 'show']);
    Route::put('update/{user}', [\App\Http\Controllers\AuthController::class, 'update']);

    Route::delete('/user/{user}', [\App\Http\Controllers\AuthController::class, 'destroy']);




    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me']);

});