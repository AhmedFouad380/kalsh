<?php

use App\Http\Controllers\Api\Provider\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Provider\ReadyServiceOrderController;
use App\Http\Controllers\Api\Provider\AuthController;
use App\Http\Controllers\Api\Provider\HomeController;
use App\Http\Controllers\Api\Provider\ChatController;

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
        Route::prefix('chat')->group(function () {
            Route::get('/', [ChatController::class, 'getChat']);
            Route::post('/send', [ChatController::class, 'sendMessage']);
        });
        Route::get('/services', [HomeController::class, 'services']);
        Route::get('/cities', [HomeController::class, 'cities']);

        Route::get('/ready-service', [HomeController::class, 'readyService']);
        Route::post('/store-form', [HomeController::class, 'StoreForm']);

        Route::prefix('offers')->group(function () {
            Route::post('/send', [ReadyServiceOrderController::class, 'sendOffer']);
        });
        Route::prefix('orders')->group(function () {
            Route::get('/pending', [ReadyServiceOrderController::class, 'pendingOrders']);
            Route::post('/accept', [ReadyServiceOrderController::class, 'acceptOrder']);
            Route::post('/reject', [ReadyServiceOrderController::class, 'rejectOrder']);
            Route::post('/rate', [ReadyServiceOrderController::class, 'rateUser']);
        });


        Route::get('/notifications', [NotificationController::class, 'index']);
    });

});

