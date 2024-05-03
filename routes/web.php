<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
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
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('isAuth');
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('isAuth');

Route::get('/colors', [ColorController::class, 'index'])->name('colors')->middleware('isAuth');
Route::post('/colors/store', [ColorController::class, 'store'])->name('colors.store')->middleware('isAuth');
Route::put('/colors/{id}/update', [ColorController::class, 'update'])->name('colors.update')->middleware('isAuth');
Route::delete('/colors/{id}/delete', [ColorController::class, 'delete'])->name('colors.delete')->middleware('isAuth');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori')->middleware('isAuth');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store')->middleware('isAuth');
Route::put('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update')->middleware('isAuth');
Route::delete('/kategori/{id}/delete', [KategoriController::class, 'delete'])->name('kategori.delete')->middleware('isAuth');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware('isAuth');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store')->middleware('isAuth');
Route::put('/produk/{id}/update', [ProdukController::class, 'update'])->name('produk.update')->middleware('isAuth');
Route::delete('/produk/{id}/delet', [ProdukController::class, 'delete'])->name('produk.delete')->middleware('isAuth');
