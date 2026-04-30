<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

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
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }
}
}
