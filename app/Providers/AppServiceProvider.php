<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
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
        // Share settings globally with all views
        View::composer('*', function ($view) {
            try {
                // Check if connection is valid and table exists
                $view->with('settings', Setting::getSettings());
            } catch (\Exception $e) {
                // If table is missing (during migration or setup), pass an empty/new Settings instance
                $view->with('settings', new Setting([
                    'name' => 'Mudassir Yaseen',
                    'tagline' => 'Full Stack Web Developer',
                    'summary' => '',
                ]));
            }
        });
    }
}
