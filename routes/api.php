<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PhoneController;
use App\Http\Controllers\Api\AuthController;

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
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/phones', [PhoneController::class, 'getPhone']);
    Route::post('/phones', [PhoneController::class, 'storePhone']);
    Route::delete('/phones/{phone}', [PhoneController::class, 'deletePhone']);
    Route::put('/phones/{phone}', [PhoneController::class, 'updatePhone']);
});

