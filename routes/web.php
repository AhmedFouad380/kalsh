<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login', function () {
    return view('auth.login');
});
Route::post('Login', [\App\Http\Controllers\frontController::class, 'login']);
Route::get('forget-password', [\App\Http\Controllers\frontController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [\App\Http\Controllers\frontController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [\App\Http\Controllers\frontController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [\App\Http\Controllers\frontController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', function () {
    return view('Admin.index');
});
Route::group(['middleware' => ['admin']], function () {

    Route::get('logout', [\App\Http\Controllers\frontController::class, 'logout']);

    Route::get('Dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('Admin_setting', [\App\Http\Controllers\Admin\AdminController::class, 'index']);
    Route::get('Admin_datatable', [\App\Http\Controllers\Admin\AdminController::class, 'datatable'])->name('Admin.datatable.data');
    Route::get('delete-Admin', [\App\Http\Controllers\Admin\AdminController::class, 'destroy']);
    Route::post('store-Admin', [\App\Http\Controllers\Admin\AdminController::class, 'store']);
    Route::get('Admin-edit/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'edit']);
    Route::post('update-Admin', [\App\Http\Controllers\Admin\AdminController::class, 'update']);
    Route::get('/add-button-Admin', function () {
        return view('Admin/Admin/button');
    });

    Route::get('User_setting', [\App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('User_datatable', [\App\Http\Controllers\Admin\UserController::class, 'datatable'])->name('User.datatable.data');
    Route::get('delete-User', [\App\Http\Controllers\Admin\UserController::class, 'destroy']);
    Route::post('store-User', [\App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::get('User-edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::post('update-User', [\App\Http\Controllers\Admin\UserController::class, 'update']);
    Route::get('/add-button-User', function () {
        return view('Admin/User/button');
    });

});

Route::get('lang/{lang}', function ($lang) {

    if (session()->has('lang')) {
        session()->forget('lang');
    }
    if ($lang == 'en') {
        session()->put('lang', 'en');
    } else {
        session()->put('lang', 'ar');
    }


    return back();
});

