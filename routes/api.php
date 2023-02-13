<?php

use App\Http\Controllers\Api\User\ReadyServiceOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;

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
            Route::post('/update-location', [\App\Http\Controllers\Api\Provider\HomeController::class, 'updateLocation']);
            Route::post('/update-language', [\App\Http\Controllers\Api\Provider\HomeController::class, 'updateLanguage']);
            Route::get('/profile', [\App\Http\Controllers\Api\Provider\AuthController::class, 'profile']);
            Route::post('/update-profile', [\App\Http\Controllers\Api\Provider\AuthController::class, 'updateProfile']);

        });
    });


    // authenticated user apis
    Route::prefix('user')->middleware('user')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/update-location', [\App\Http\Controllers\Api\User\HomeController::class, 'updateLocation']);
            Route::post('/update-language', [\App\Http\Controllers\Api\User\HomeController::class, 'updateLanguage']);
            Route::get('/profile', [\App\Http\Controllers\Api\User\AuthController::class, 'profile']);
            Route::post('/update-profile', [\App\Http\Controllers\Api\User\AuthController::class, 'updateProfile']);
        });

            Route::prefix('ready-services')->group(function () {
            Route::post('/create-order', [ReadyServiceOrderController::class, 'createOrder']);
        });
    });


// guest user apis
Route::prefix('user')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/check-phone', [AuthController::class, 'checkPhone']);
        Route::post('/Email-otp', [AuthController::class, 'EmailOtp']);
        Route::post('/email-login', [AuthController::class, 'emailLogin']);
        Route::post('/phone-login', [AuthController::class, 'phoneLogin']);
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
