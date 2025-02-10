<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::prefix('order')->name('order.')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('confirm', [CheckoutController::class, 'confirm'])->name('confirm');
    Route::get('complete', [CheckoutController::class, 'complete'])->name('complete');
});

Route::get('/storage/products/{filename}', function ($filename) {
    return response()->file(storage_path('app/public/products/' . $filename));
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('index');
            Route::get('/add', [AdminProductController::class, 'create'])->name('add');
            Route::post('/store', [AdminProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [AdminProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('destroy');
            Route::post('/update-image-order', [AdminProductController::class, 'updateImageOrder'])->name('update-image-order');
        });

        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/{id}', [OrderController::class, 'show'])->name('show');
            Route::put('/{id}/update-status', [OrderController::class, 'updateStatus'])->name('updateStatus');
        });
    });
});

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
