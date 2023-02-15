<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\Admin\ImportantNumbersController;
use App\Http\Controllers\Admin\ProvidersController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ScreensController;
use App\Http\Controllers\Admin\Ready\ReadyServicesController;
use App\Http\Controllers\Admin\Ready\ReadyOrdersController;

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
})->name('login');
Route::post('Login', [\App\Http\Controllers\frontController::class, 'login']);
Route::get('forget-password', [\App\Http\Controllers\frontController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [\App\Http\Controllers\frontController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}/{email}', [\App\Http\Controllers\frontController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [\App\Http\Controllers\frontController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['admin']], function () {

    Route::get('Setting', [\App\Http\Controllers\frontController::class, 'Setting'])->name('profile');

    Route::get('/', function () {
        return view('Admin.index');
    })->name('dashboard.index');
    Route::get('logout', [\App\Http\Controllers\frontController::class, 'logout']);

    Route::get('Dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('Admin_setting', [AdminController::class, 'index'])->name('admins.index');
    Route::get('Admin_datatable', [AdminController::class, 'datatable'])->name('Admin.datatable.data');
    Route::get('delete-Admin', [AdminController::class, 'destroy']);
    Route::post('store-Admin', [AdminController::class, 'store']);
    Route::get('Admin-edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');
    Route::post('update-Admin', [AdminController::class, 'update']);
    Route::get('/add-button-Admin', function () {
        return view('Admin/Admin/button');
    });


    //users
    Route::get('User_setting', [UserController::class, 'index'])->name('users.index');
    Route::get('User_datatable', [UserController::class, 'datatable'])->name('User.datatable.data');
    Route::get('delete-User', [UserController::class, 'destroy']);
    Route::post('store-User', [UserController::class, 'store']);
    Route::get('User-edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::get('User-edit/show/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('update-User', [UserController::class, 'update']);
    Route::get('/add-button-User', function () {
        return view('Admin/User/button');
    });

    Route::group(['prefix' => 'users', 'as' => 'users'], function () {
        Route::post('/change_active', [UserController::class, 'changeActive'])->name('.change_active');

        Route::get('/show/{id}', [UserController::class, 'show'])->name('.show');
        Route::get('/show/{id}/orders', [UserController::class, 'orders'])->name('.show.orders');
        Route::get('/show/orders/datatable/{id}', [UserController::class, 'ordersDatatable'])->name('.orders.datatable');
        Route::get('/show/rates/datatable/{id}', [UserController::class, 'ratesDatatable'])->name('.rates.datatable');

        Route::get('/show/{id}/rates', [UserController::class, 'rates'])->name('.show.rates');
        Route::get('/show/{id}/offers', [UserController::class, 'offers'])->name('.show.offers');
    });

    Route::group(['prefix' => 'services', 'as' => 'services'], function () {
        Route::get('/', [ServicesController::class, 'index'])->name('.index');
        Route::get('/datatable', [ServicesController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [ServicesController::class, 'create'])->name('.create');
        Route::post('/store', [ServicesController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [ServicesController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [ServicesController::class, 'update'])->name('.update');
        Route::post('/change_active', [ServicesController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', function () {
            return view('Admin/Services/button');
        });
    });

    Route::group(['prefix' => 'providers', 'as' => 'providers'], function () {
        Route::get('/', [ProvidersController::class, 'index'])->name('.index');
        Route::get('/datatable', [ProvidersController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [ProvidersController::class, 'create'])->name('.create');
        Route::post('/store', [ProvidersController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [ProvidersController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [ProvidersController::class, 'update'])->name('.update');
        Route::get('delete', [ProvidersController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [ProvidersController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [ProvidersController::class, 'table_buttons'])->name('.table_buttons');

        Route::get('/show/{id}', [ProvidersController::class, 'show'])->name('.show');
        Route::get('/show/{id}/orders', [ProvidersController::class, 'orders'])->name('.show.orders');
        Route::get('/show/orders/datatable/{id}', [ProvidersController::class, 'ordersDatatable'])->name('.orders.datatable');
        Route::get('/show/rates/datatable/{id}', [ProvidersController::class, 'ratesDatatable'])->name('.rates.datatable');

        Route::get('/show/{id}/rates', [ProvidersController::class, 'rates'])->name('.show.rates');
        Route::get('/show/{id}/offers', [ProvidersController::class, 'offers'])->name('.show.offers');

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

    Route::group(['prefix' => 'sliders', 'as' => 'sliders'], function () {
        Route::get('/', [SlidersController::class, 'index'])->name('.index');
        Route::get('/datatable', [SlidersController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [SlidersController::class, 'create'])->name('.create');
        Route::post('/store', [SlidersController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [SlidersController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [SlidersController::class, 'update'])->name('.update');
        Route::get('delete', [SlidersController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [SlidersController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [SlidersController::class, 'table_buttons'])->name('.table_buttons');
    });

    Route::group(['prefix' => 'screens', 'as' => 'screens'], function () {
        Route::get('/', [ScreensController::class, 'index'])->name('.index');
        Route::get('/datatable', [ScreensController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [ScreensController::class, 'create'])->name('.create');
        Route::post('/store', [ScreensController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [ScreensController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [ScreensController::class, 'update'])->name('.update');
        Route::get('delete', [ScreensController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [ScreensController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [ScreensController::class, 'table_buttons'])->name('.table_buttons');
    });
    Route::group(['prefix' => 'cities', 'as' => 'cities'], function () {
        Route::get('/', [CitiesController::class, 'index'])->name('.index');
        Route::get('/datatable', [CitiesController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [CitiesController::class, 'create'])->name('.create');
        Route::post('/store', [CitiesController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [CitiesController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [CitiesController::class, 'update'])->name('.update');
        Route::get('delete', [CitiesController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [CitiesController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [CitiesController::class, 'table_buttons'])->name('.table_buttons');
    });
    Route::group(['prefix' => 'ready'], function () {
        Route::group(['prefix' => 'ready_services', 'as' => 'ready_services'], function () {
            Route::get('/', [ReadyServicesController::class, 'index'])->name('.index');
            Route::get('/datatable', [ReadyServicesController::class, 'datatable'])->name('.datatable');
            Route::get('/create', [ReadyServicesController::class, 'create'])->name('.create');
            Route::post('/store', [ReadyServicesController::class, 'store'])->name('.store');
            Route::get('/edit/{id}', [ReadyServicesController::class, 'edit'])->name('.edit');
            Route::post('/update/{id}', [ReadyServicesController::class, 'update'])->name('.update');
            Route::get('delete', [ReadyServicesController::class, 'destroy'])->name('.delete');
            Route::post('/change_active', [ReadyServicesController::class, 'changeActive'])->name('.change_active');
            Route::post('/change_is_checked', [ReadyServicesController::class, 'changeIsChecked'])->name('.change_is_checked');
            Route::get('/add-button', [ReadyServicesController::class, 'table_buttons'])->name('.table_buttons');
        });
        Route::group(['prefix' => 'ready_orders', 'as' => 'ready_orders'], function () {
            Route::get('/', [ReadyOrdersController::class, 'index'])->name('.index');
            Route::get('/datatable', [ReadyOrdersController::class, 'datatable'])->name('.datatable');
            Route::get('/create', [ReadyOrdersController::class, 'create'])->name('.create');
            Route::post('/store', [ReadyOrdersController::class, 'store'])->name('.store');
            Route::get('/show/{id}', [ReadyOrdersController::class, 'show'])->name('.show');
            Route::post('/update/{id}', [ReadyOrdersController::class, 'update'])->name('.update');
            Route::get('delete', [ReadyOrdersController::class, 'destroy'])->name('.delete');
            Route::post('/change_active', [ReadyOrdersController::class, 'changeActive'])->name('.change_active');
            Route::post('/change_is_checked', [ReadyOrdersController::class, 'changeIsChecked'])->name('.change_is_checked');
            Route::get('/add-button', [ReadyOrdersController::class, 'table_buttons'])->name('.table_buttons');
        });
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

Route::get('nearest', function () {
    $providers = \App\Models\Provider::active()
        ->online()
        ->select('providers.*', DB::raw('
                              6371 * ACOS(
                                  LEAST(
                                    1.0,
                                    COS(RADIANS(lat))
                                    * COS(RADIANS(' . '31.1' . '))
                                    * COS(RADIANS(lng - ' . '30.2' . '))
                                    + SIN(RADIANS(lat))
                                    * SIN(RADIANS(' . '31.1' . '))
                                  )
                                ) as distance'))
        ->having("distance", "<", 30)
        ->orderBy("distance", 'asc')
        ->get();
    return ($providers);

});


Route::get('/sendNotification', function () {
    dd(send(['eKEVjzBlSl6BYvWnmbkVRp:APA91bFvccfkGc9V6g-LjPnntgxAETiAI-OS-vjmdvsOoes5YBIKA1lhB1VQIRxlxw80q10EsBNTAP7B6KfGseA8sJB6JHU2_NidoFTeezg5c_OmS5UEdSdipUhDMt1HLqyd6pflZjTk']
        , 'test', 'test message', 'order', null, null));
    return 'notification sent';
});

