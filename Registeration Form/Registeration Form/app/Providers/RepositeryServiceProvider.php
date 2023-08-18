<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositeryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            "App\Interfaces\UserRegisteration\UserRegisterationRepositeryInterface",   
            "App\Repositery\UserRegisteration\UserRegisterationRepositery",     
          );
    }
    public function boot(): void
    {
    }
}
