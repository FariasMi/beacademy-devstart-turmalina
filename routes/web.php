<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CheckoutController,
    UserController,
    HomeController,
    ProductController,
    StoreController,
    OrderController
};
use Aws\Middleware;

require __DIR__ . '/auth.php';

Route::post('/checkout/ticket', [CheckoutController::class, 'ticket'])->name('checkout.ticket');
Route::post('/checkout/card', [CheckoutController::class, 'card'])->name('checkout.card');

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/cart', [OrderController::class, 'index'])->middleware('auth')->name('cart.index');
Route::post('/cart/store', [OrderController::class, 'store'])->middleware('auth')->name('cart.store');
Route::post('/cart/final', [OrderController::class, 'final'])->name('cart.final');
Route::get('/cart/orders', [OrderController::class, 'showOrders'])->name('cart.orders');
Route::get('/cart/user/{id}', [OrderController::class, 'show'])->name('cart.show');
Route::post('/cart/payment/', [OrderController::class, 'final'])->name('cart.payment');
Route::delete('/cart/delete/{id}/{order_id}', [OrderController::class, 'delete_order'])->name('cart.delete');

Route::get('/address/create/{id}', [AddressController::class, 'create'])->middleware('auth', 'confirm_id')->name('address.create');
Route::post('/address/create/{id}', [AddressController::class, 'store'])->middleware('auth', 'confirm_id')->name('address.store');
Route::delete('/address/delete/{id}', [AddressController::class, 'delete'])->middleware('auth')->name('address.delete');

Route::get('/user/create', [UserController::class, 'create'])->middleware(['auth', 'is_admin'])->name('user.create');
Route::post('/user/create', [RegisteredUserController::class, 'store'])->middleware(['auth', 'is_admin'])->name('user.store');
Route::get('/user/{id}/{address_empty?}', [UserController::class, 'show'])->middleware('auth', 'confirm_id')->name('user.show');
Route::get('/edit/{id}', [UserController::class, 'edit'])->middleware('auth', 'confirm_id')->name('user.edit');
Route::put('/edit/{id}', [UserController::class, "update"])->name("user.update");
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'is_admin'])->name('dashboard');
Route::delete('/delete/{id}', [UserController::class, 'delete'])->middleware(['auth', 'is_admin'])->name('user.delete');

Route::get('/product/edit/{id}',[ProductController::class, 'edit'])->middleware(['auth', 'is_admin'])->name('product.edit');
Route::put('/product/edit/{id}',[ProductController::class, 'update'])->name('product.update');
Route::get('/products', [ProductController::class, 'index'])->middleware(['auth', 'is_admin'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product', [ProductController::class, 'search'])->name('search');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware(['auth', 'is_admin'])->name('product.delete');
Route::get('/products/{id}',[ProductController::class, 'show'])->middleware('auth')->name('products.show');

Route::get('/store/{section}', [StoreController::class, 'index'])->name('store.index');