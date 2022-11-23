<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

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
        Inertia::share([
            'errors' => function () {
                return session()->get('errors') ? session()->get('errors')->getBag('default')->getMessages() : (object) [];
            },
        ]);

        Inertia::share('flash', function () {
            return [
                'success' => session()->get('success'),
            ];
        });

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        if (env('APP_ENV') == 'production') {
            URL::forceScheme('https');
        }
    }
}
