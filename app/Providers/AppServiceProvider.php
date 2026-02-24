<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SchoolProfile;

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
        // Share profile data to all frontend views (for footer)
        View::composer('frontend.*', function ($view) {
            $view->with('profile', SchoolProfile::first());
        });

        View::composer('frontend.layout.*', function ($view) {
            $view->with('profile', SchoolProfile::first());
        });
    }
}
