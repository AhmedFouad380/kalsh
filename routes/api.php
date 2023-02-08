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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/home',[\App\Http\Controllers\Api\User\HomeController::class,'index']);
Route::get('/stores',[\App\Http\Controllers\Api\User\StoresController::class,'index']);
Route::get('/news',[\App\Http\Controllers\Api\User\NewsController::class,'index']);
Route::get('/importantNumbers',[\App\Http\Controllers\Api\User\ImportantNumbersController::class,'index']);
