<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Provider\ReadyServiceOrderController;
use App\Http\Controllers\Api\Provider\AuthController;
use App\Http\Controllers\Api\Provider\HomeController;


Route::prefix('provider')->group(function () {

    //routes not should authenticated

    Route::middleware('guest')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/check-phone', [AuthController::class, 'checkPhone']);
            Route::post('/phone-login', [AuthController::class, 'phoneLogin']);
        });
    });

    //routes should authenticated
    Route::middleware('provider')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/update-location', [HomeController::class, 'updateLocation']);
            Route::post('/update-language', [HomeController::class, 'updateLanguage']);
            Route::get('/profile', [AuthController::class, 'profile']);
            Route::post('/update-profile', [AuthController::class, 'updateProfile']);
        });

        Route::get('/pending-orders', [ReadyServiceOrderController::class, 'pendingOrders']);
        Route::prefix('offers')->group(function () {
            Route::post('/send', [ReadyServiceOrderController::class, 'sendOffer']);
        });
    });

});

