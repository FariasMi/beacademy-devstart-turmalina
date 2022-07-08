<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    HomeController
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/user/create', [UserController::class, 'create'])->middleware(['auth', 'is_admin'])->name('user.create');
Route::post('/user/create', [RegisteredUserController::class, 'store'])->middleware(['auth', 'is_admin'])->name('user.store');
Route::put('/edit/{id}', [UserController::class, "update"])->name("user.update");
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'is_admin'])->name('dashboard');
Route::delete('/delete/{id}', [UserController::class, 'delete'])->middleware(['auth', 'is_admin'])->name('user.delete');

require __DIR__ . '/auth.php';
