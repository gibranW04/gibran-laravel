<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * =========================
 * ADMIN ROUTES
 * =========================
 */
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn () => view('admin.dashboard'))
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
    });

/**
 * =========================
 * USER ROUTES
 * =========================
 */
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', fn () => view('user.dashboard'));
});
