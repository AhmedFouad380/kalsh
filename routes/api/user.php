<?php

use App\Http\Controllers\Api\User\DreamServiceOrderController;
use App\Http\Controllers\Api\User\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Provider\ReadyServiceOrderController as ProviderOrders;
use App\Http\Controllers\Api\Provider\AuthController as ProviderAuth;
use App\Http\Controllers\Api\Provider\HomeController as ProviderHome;

use App\Http\Controllers\Api\User\ReadyServiceOrderController;
use App\Http\Controllers\Api\User\ReadyServicesController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\HomeController;
use \App\Http\Controllers\Api\User\StoresController;
use \App\Http\Controllers\Api\User\NewsController;
use \App\Http\Controllers\Api\User\ImportantNumbersController;
use \App\Http\Controllers\Api\User\ChatController;
use \App\Http\Controllers\Api\PageController;
use \App\Http\Controllers\Api\User\CarSerivceController;
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


// authenticated user apis
Route::prefix('user')->group(function () {
    //guest user apis
    Route::prefix('auth')->group(function () {
        Route::post('/check-phone', [AuthController::class, 'checkPhone']);
        Route::post('/Email-otp', [AuthController::class, 'EmailOtp']);
        Route::post('/email-login', [AuthController::class, 'emailLogin']);
        Route::post('/phone-login', [AuthController::class, 'phoneLogin']);
    });

    //routes should authenticated
    Route::middleware('user')->group(function () {
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

        // ready services
        Route::prefix('ready-services')->group(function () {
            Route::post('/create-order', [ReadyServiceOrderController::class, 'createOrder']);
            Route::get('/orders', [ReadyServiceOrderController::class, 'orders']);
            Route::post('/accept-offer', [ReadyServiceOrderController::class, 'acceptOffer']);
            Route::post('/reject-offer', [ReadyServiceOrderController::class, 'rejectOffer']);
            Route::post('/cancel-order', [ReadyServiceOrderController::class, 'cancelOrder']);
        });

        // dream services
        Route::prefix('dream-services')->group(function () {
            Route::get('/get-nearest-providers', [DreamServiceOrderController::class, 'getNearestProviders']);
            Route::post('/create-order', [DreamServiceOrderController::class, 'createOrder']);
            // todo:: pay for service
        });
        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::post('/order/rate', [ReadyServiceOrderController::class, 'rateProvider']);
        Route::prefix('car-services')->group(function () {
            Route::post('/create-order', [CarSerivceController::class, 'createOrder']);
            Route::get('/order', [CarSerivceController::class, 'order']);
            Route::post('/accept-offer', [CarSerivceController::class, 'acceptOffer']);
            Route::post('/reject-offer', [CarSerivceController::class, 'rejectOffer']);
            Route::post('/cancel-order', [CarSerivceController::class, 'cancelOrder']);
        });
    });

});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/stores', [StoresController::class, 'index']);
Route::get('/pray-time/slider', [StoresController::class, 'pray_slider']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/importantNumbers', [ImportantNumbersController::class, 'index']);
Route::get('/readyServices', [ReadyServicesController::class, 'index']);
Route::get('/carServices', [CarSerivceController::class, 'index']);
Route::get('page',[PageController::class,'Page']);
