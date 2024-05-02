<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/shop', [LandingController::class, 'shop'])->name('shop');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/user', [UserController::class, 'index'])->name('user');

Route::get('/colors', [ColorController::class, 'index'])->name('colors');
Route::post('/colors/store', [ColorController::class, 'store'])->name('colors.store');
Route::put('/colors/{id}/update', [ColorController::class, 'update'])->name('colors.update');
Route::delete('/colors/{id}/delete', [ColorController::class, 'delete'])->name('colors.delete');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
Route::put('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}/delete', [KategoriController::class, 'delete'])->name('kategori.delete');
