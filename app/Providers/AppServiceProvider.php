<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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

        // ✅ AMAN: hanya jalan jika DB & tabel sudah siap
        if (Schema::hasTable('categories')) {
            View::composer('*', function ($view) {
                $view->with('categories', Category::all());
            });
        }

        // Midtrans (aman, tidak query DB)
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$clientKey = config('services.midtrans.clientKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }
}
