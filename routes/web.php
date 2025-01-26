<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/products/show', function () {
    return view('products.show');
});

Route::get('/cart', function () {
    return view('cart.index');
});

Route::get('/order/checkout', function () {
    return view('order.checkout');
});

Route::get('/order/complete', function () {
    return view('order.complete');
});

Route::get('/admin/login', function () {
    return view('admin.login');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/products', function () {
    return view('admin.products.index');
});

Route::get('/admin/products/create', function () {
    return view('admin.products.create');
});

Route::get('/admin/products/edit', function () {
    return view('admin.products.edit');
});

Route::get('/admin/products/add', function () {
    return view('admin.products.add');
});

Route::get('/admin/orders/show', function () {
    return view('admin.orders.show');
});

Route::post('/order/confirm', function () {
    return 'Order confirmed';
})->name('order.confirm');
