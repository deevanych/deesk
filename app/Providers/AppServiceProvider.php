<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

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
        //
        date_default_timezone_set('Europe/Moscow');
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        Carbon::setLocale(config('app.locale'));
    }
}
