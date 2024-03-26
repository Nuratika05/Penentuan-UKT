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
        if (app()->isProduction()) {
            ($this->{'app'}['request'] ?? null)?->server?->set('HTTPS','on');
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
