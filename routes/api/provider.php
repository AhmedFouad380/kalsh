<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Provider\ReadyServiceOrderController;
use App\Http\Controllers\Api\Provider\AuthController;
use App\Http\Controllers\Api\Provider\HomeController;


Route::prefix('provider')->group(function () {

    //routes not should authenticated

    Route::prefix('auth')->group(function () {
        Route::post('/check_phone', [AuthController::class, 'check_phone']);
        Route::post('/phone_login', [AuthController::class, 'phone_login']);
    });

    //routes should authenticated
    Route::middleware('provider')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/update-location', [HomeController::class, 'updateLocation']);
            Route::post('/update-language', [HomeController::class, 'updateLanguage']);
            Route::get('/profile', [AuthController::class, 'profile']);
            Route::post('/update-profile', [AuthController::class, 'updateProfile']);
        });

        Route::prefix('orders')->group(function () {
            Route::get('/', [ReadyServiceOrderController::class, 'orders']);
            Route::post('/send-offer', [ReadyServiceOrderController::class, 'sendOffer']);
        });
    });

});

