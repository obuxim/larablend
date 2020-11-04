<?php

namespace Duoneos\Larablend;

use Illuminate\Support\ServiceProvider;

class LarablendServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/routes/routes.php");
        $this->loadMigrationsFrom(__DIR__."/database/migrations");
        $this->loadViewsFrom(__DIR__."/views", 'larablend');
        $this->publishes([
            __DIR__."/public" => public_path('vendor/larablend')
        ], 'public');
    }

    public function register()
    {

    }
}
