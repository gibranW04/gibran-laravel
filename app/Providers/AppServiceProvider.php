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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * 1. Force HTTPS di Production (Railway)
         * Ini memperbaiki masalah mixed content (CSS/JS tidak load).
         */
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        /**
         * 2. Share Categories ke SEMUA VIEW (FIX ERROR)
         * Ini MENGHILANGKAN:
         * Undefined variable $categories
         */
        View::share('categories', Category::all());

        /**
         * 3. Konfigurasi Midtrans
         */
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$clientKey = config('services.midtrans.clientKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }
}
