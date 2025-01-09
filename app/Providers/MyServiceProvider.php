<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(my_class,function($app){
            
        })
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
