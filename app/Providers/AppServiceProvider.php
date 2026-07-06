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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bind the public path dynamically to support Hostinger public_html layout
        $this->app->bind('path.public', function () {
            if (is_dir(base_path('public_html'))) {
                return base_path('public_html');
            }
            if (is_dir(base_path('../public_html'))) {
                return realpath(base_path('../public_html'));
            }
            return base_path('public');
        });
    }
}
