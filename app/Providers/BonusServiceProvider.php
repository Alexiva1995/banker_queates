<?php

namespace App\Providers;

use App\Services\BonusService;
use Illuminate\Support\ServiceProvider;

class BonusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BonusService::class, function($app) {
            return new BonusService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
