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

Route::prefix('user')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/check_phone', [AuthController::class, 'check_phone']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    });
    Route::get('/profile', [AuthController::class, 'profile']);
});
Route::prefix('provider')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [ProviderAuth::class, 'login']);
        Route::post('/register', [ProviderAuth::class, 'register']);
    });
    Route::get('/profile', [ProviderAuth::class, 'profile']);
});
