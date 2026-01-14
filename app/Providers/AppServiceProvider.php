<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Wajib di-import untuk Force HTTPS

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
        /**
         * 1. Force HTTPS di Production (Railway)
         * Ini memperbaiki tampilan CSS/JS yang hancur karena masalah Mixed Content.
         */
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        /**
         * 2. Konfigurasi Midtrans
         * Pastikan key "midtrans" sudah terdaftar di config/services.php
         */
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$clientKey = config('services.midtrans.clientKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }
}
