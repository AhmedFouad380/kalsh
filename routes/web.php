<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\Admin\ImportantNumbersController;

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



Route::group(['middleware' => ['admin']], function () {

    Route::get('Setting', [\App\Http\Controllers\frontController::class, 'Setting'])->name('profile');

    Route::get('/', function () {
        return view('Admin.index');
    });
    Route::get('logout', [\App\Http\Controllers\frontController::class, 'logout']);

    Route::get('Dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('Admin_setting', [AdminController::class, 'index']);
    Route::get('Admin_datatable', [AdminController::class, 'datatable'])->name('Admin.datatable.data');
    Route::get('delete-Admin', [AdminController::class, 'destroy']);
    Route::post('store-Admin', [AdminController::class, 'store']);
    Route::get('Admin-edit/{id}', [AdminController::class, 'edit']);
    Route::post('update-Admin', [AdminController::class, 'update']);
    Route::get('/add-button-Admin', function () {
        return view('Admin/Admin/button');
    });

    //users
    Route::get('User_setting', [UserController::class, 'index']);
    Route::get('User_datatable', [UserController::class, 'datatable'])->name('User.datatable.data');
    Route::get('delete-User', [UserController::class, 'destroy']);
    Route::post('store-User', [UserController::class, 'store']);
    Route::get('User-edit/{id}', [UserController::class, 'edit']);
    Route::post('update-User', [UserController::class, 'update']);
    Route::get('/add-button-User', function () {
        return view('Admin/User/button');
    });

    Route::group(['prefix' => 'services', 'as' => 'services'], function () {
        Route::get('/', [ServicesController::class, 'index'])->name('.index');
        Route::get('/datatable', [ServicesController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [ServicesController::class, 'create'])->name('.create');
        Route::post('/store', [ServicesController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [ServicesController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [ServicesController::class, 'update'])->name('.update');
        Route::get('/{id}/delete', [ServicesController::class, 'delete'])->name('.delete');
        Route::post('/change_active', [ServicesController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', function () {
            return view('Admin/Services/button');
        });
    });

    Route::group(['prefix' => 'news', 'as' => 'news'], function () {
        Route::get('/', [NewsController::class, 'index'])->name('.index');
        Route::get('/datatable', [NewsController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [NewsController::class, 'create'])->name('.create');
        Route::post('/store', [NewsController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [NewsController::class, 'update'])->name('.update');
        Route::get('delete', [NewsController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [NewsController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [NewsController::class, 'table_buttons'])->name('.table_buttons');
    });

    Route::group(['prefix' => 'stores', 'as' => 'stores'], function () {
        Route::get('/', [StoresController::class, 'index'])->name('.index');
        Route::get('/datatable', [StoresController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [StoresController::class, 'create'])->name('.create');
        Route::post('/store', [StoresController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [StoresController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [StoresController::class, 'update'])->name('.update');
        Route::get('delete', [StoresController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [StoresController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [StoresController::class, 'table_buttons'])->name('.table_buttons');
    });

    Route::group(['prefix' => 'important_numbers', 'as' => 'important_numbers'], function () {
        Route::get('/', [ImportantNumbersController::class, 'index'])->name('.index');
        Route::get('/datatable', [ImportantNumbersController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [ImportantNumbersController::class, 'create'])->name('.create');
        Route::post('/store', [ImportantNumbersController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [ImportantNumbersController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [ImportantNumbersController::class, 'update'])->name('.update');
        Route::get('delete', [ImportantNumbersController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [ImportantNumbersController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [ImportantNumbersController::class, 'table_buttons'])->name('.table_buttons');
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

