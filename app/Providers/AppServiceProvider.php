<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!session()->get('lang')){
            session()->put('lang','en');
        }
        if (request()->header('lang')){
            app()->setLocale(request()->header('lang'));
        }else{
            app()->setLocale('ar');
        }
    }
}
