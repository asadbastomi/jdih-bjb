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
        // Share social media links across all views
        $social = \App\Social::all();
        view()->share('social', $social);
        
        // Share stats across all views
        $stats = (object) [
            'pageviews' => (object) ['value' => '14,420'],
            'uniques' => (object) ['value' => '6,419'],
        ];
        view()->share('stats', $stats);
    }
}
