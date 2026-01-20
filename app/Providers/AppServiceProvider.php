<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS di Railway
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // ⚠️ JANGAN QUERY DB DI SINI
    }

    /**
     * Dipanggil SETELAH app benar-benar siap
     */
    public function booted(): void
    {
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
