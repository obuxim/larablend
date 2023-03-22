<?php

namespace Duoneos\Larablend;

use Illuminate\Support\ServiceProvider;

class LarablendServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__."/routes/web.php");
        $this->loadRoutesFrom(__DIR__."/routes/api.php");
        $this->loadViewsFrom(__DIR__.'/views', 'larablend');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([
            __DIR__.'/css' => public_path('vendor/larablend/css'),
        ], 'public');
        $this->publishes([
            __DIR__.'/js' => public_path('vendor/larablend/js'),
        ], 'public');
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/larablend/assets'),
        ], 'public');
    }

    public function register(): void
    {

    }
}
