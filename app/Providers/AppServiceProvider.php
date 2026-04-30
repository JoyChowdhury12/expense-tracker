<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // hiuse Illuminate\Support\Facades\URL;


public function boot()
{
    if ($this->app->environment('production')) {
        URL::forceScheme('https');

        Request::setTrustedProxies(
            ['*'],
            Request::HEADER_X_FORWARDED_ALL
        );
    }
}
}
