<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


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

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'is_admin'])->name('dashboard');

// ROTAS DO CRUD PRODUTOS 

Route::get('/produtos',[ProductController::class, 'index'])->name('products.index');


require __DIR__ . '/auth.php';
