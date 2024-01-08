<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * Change public folder to public_html
         * change more into bootstrap/app.php
         */
        /*
        $this -> app -> bind('path.public', function() { 
            return base_path('public_html'); 
        });
        */
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
