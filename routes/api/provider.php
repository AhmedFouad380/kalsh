<?php

use App\Http\Controllers\Api\Provider\DreamServiceOrderController;
use App\Http\Controllers\Api\Provider\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Provider\ReadyServiceOrderController;
use App\Http\Controllers\Api\Provider\AuthController;
use App\Http\Controllers\Api\Provider\HomeController;
use App\Http\Controllers\Api\Provider\ChatController;
use App\Http\Controllers\Api\Provider\CarServiceController;
use App\Http\Controllers\Api\Provider\DeliveryServiceController;
use \App\Http\Controllers\Api\PageController;

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
            Route::get('/logout', [AuthController::class, 'logout']);
            Route::post('/update-location', [HomeController::class, 'updateLocation']);
            Route::post('/update-language', [HomeController::class, 'updateLanguage']);
            Route::get('/profile', [AuthController::class, 'profile']);
            Route::post('/update-profile', [AuthController::class, 'updateProfile']);
            Route::post('/change-online-status', [AuthController::class, 'changeOnline']);
        });
        Route::prefix('chat')->group(function () {
            Route::get('/', [ChatController::class, 'getChat']);
            Route::post('/send', [ChatController::class, 'sendMessage']);
        });
        Route::get('/registered_service', [HomeController::class, 'registered_service']);
        Route::get('/services', [HomeController::class, 'services']);
        Route::get('/cities', [HomeController::class, 'cities']);

        Route::get('/ready-service', [HomeController::class, 'readyService']);
        Route::post('/store-form', [HomeController::class, 'storeForm']);

        Route::prefix('offers')->group(function () {
            Route::post('/send', [ReadyServiceOrderController::class, 'sendOffer']);
        });
        Route::prefix('orders')->group(function () {
            Route::get('/', [ReadyServiceOrderController::class, 'orders']);
            Route::get('/pending', [ReadyServiceOrderController::class, 'pendingOrders']);
            Route::post('/accept', [ReadyServiceOrderController::class, 'acceptOrder']);
            Route::post('/complete', [ReadyServiceOrderController::class, 'completeOrder']);
            Route::post('/reject', [ReadyServiceOrderController::class, 'rejectOrder']);
            Route::post('/rate', [ReadyServiceOrderController::class, 'rateUser']);
        });


        // todo:: accept/reject order
        // dream services
        Route::prefix('dream-services')->group(function () {
            Route::prefix('orders')->group(function () {
                Route::get('/reject-unknown', [DreamServiceOrderController::class, 'rejectOrder']);
                Route::get('/accept', [DreamServiceOrderController::class, 'acceptOrder']);
                Route::get('/complete', [DreamServiceOrderController::class, 'completeOrder']);
            });
        });
        Route::prefix('car_service')->group(function () {
                Route::post('/acceptOrder', [CarServiceController::class, 'acceptOrder']);
                Route::post('/StartOrder', [CarServiceController::class, 'StartOrder']);
                Route::post('/rejectOrder', [CarServiceController::class, 'rejectOrder']);
                Route::post('/completeOrder', [CarServiceController::class, 'completeOrder']);
        });
        Route::prefix('delivery-service')->group(function () {
            Route::get('/details', [DeliveryServiceController::class, 'details']);

            Route::post('/accept-order', [DeliveryServiceController::class, 'acceptOrder']);
            Route::post('/reject-order', [DeliveryServiceController::class, 'rejectOrder']);
            Route::post('/complete-order', [DeliveryServiceController::class, 'completeOrder']);
            Route::post('/update-cost', [DeliveryServiceController::class, 'updateCost']);
        });


        Route::get('/notifications', [NotificationController::class, 'index']);
    });

});
Route::get('page', [PageController::class, 'Page']);

