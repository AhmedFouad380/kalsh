<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\Provider\AuthController as ProviderAuth;

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

    Route::prefix('provider')->middleware('provider')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/update_location', [\App\Http\Controllers\Api\Provider\AuthController::class, 'update_location']);
            Route::get('/profile', [ProviderAuth::class, 'profile']);

        });
    });


    Route::prefix('user')->middleware('user')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/update_location', [\App\Http\Controllers\Api\User\AuthController::class, 'update_location']);
            Route::get('/profile', [\App\Http\Controllers\Api\User\AuthController::class, 'profile']);

        });
    });



Route::prefix('user')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/check_phone', [AuthController::class, 'check_phone']);
        Route::post('/Email_otp', [AuthController::class, 'EmailOtp']);
        Route::post('/email_login', [AuthController::class, 'emailLogin']);
        Route::post('/phone_login', [AuthController::class, 'phone_login']);

    });
});
Route::prefix('provider')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/check_phone', [\App\Http\Controllers\Api\Provider\AuthController::class, 'check_phone']);
        Route::post('/phone_login', [\App\Http\Controllers\Api\Provider\AuthController::class, 'phone_login']);
    });
});

Route::get('/home',[\App\Http\Controllers\Api\User\HomeController::class,'index']);
Route::get('/stores',[\App\Http\Controllers\Api\User\StoresController::class,'index']);
Route::get('/news',[\App\Http\Controllers\Api\User\NewsController::class,'index']);
Route::get('/importantNumbers',[\App\Http\Controllers\Api\User\ImportantNumbersController::class,'index']);
