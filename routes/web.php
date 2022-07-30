<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    HomeController,
    ProductController,
    StoreController,
    OrderController
};
require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/carts', [OrderController::class, 'index'])->name('cart.index');
Route::get('/cart/{id}', [OrderController::class, 'cart'])->name('cart.cart');
Route::get('/cart/user/{id}', [OrderController::class, 'show'])->name('cart.show');
Route::post('cart/store', [OrderController::class, 'store'])->name('cart.store');

Route::get('/address/create/{id}', [AddressController::class, 'create'])->middleware('auth', 'confirm_id')->name('address.create');
Route::post('/address/create/{id}', [AddressController::class, 'store'])->middleware('auth', 'confirm_id')->name('address.store');
Route::delete('/address/delete/{id}', [AddressController::class, 'delete'])->middleware('auth')->name('address.delete');

Route::get('/user/create', [UserController::class, 'create'])->middleware(['auth', 'is_admin'])->name('user.create');
Route::post('/user/create', [RegisteredUserController::class, 'store'])->middleware(['auth', 'is_admin'])->name('user.store');
Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth', 'confirm_id')->name('user.show');
Route::put('/edit/{id}', [UserController::class, "update"])->name("user.update");
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'is_admin'])->name('dashboard');
Route::delete('/delete/{id}', [UserController::class, 'delete'])->middleware(['auth', 'is_admin'])->name('user.delete');

Route::get('/product/edit/{id}',[ProductController::class, 'edit'])->middleware(['auth', 'is_admin'])->name('product.edit');
Route::put('/product/edit/{id}',[ProductController::class, 'update'])->name('product.update');
Route::get('/products', [ProductController::class, 'index'])->middleware(['auth', 'is_admin'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product', [ProductController::class, 'search'])->name('search');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware(['auth', 'is_admin'])->name('product.delete');
Route::get('/products/{id}',[ProductController::class, 'show'])->middleware(['auth', 'confirm_id'])->name('products.show');

Route::get('/store/{section}', [StoreController::class, 'index'])->name('store.index');

