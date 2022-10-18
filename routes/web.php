<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesananController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('account')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('user.login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login.auth');
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::prefix('/orders')->group(function(){
    Route::post('/buatpesanan', [PesananController::class, 'buatPesanan'])->name('order.buat');
});


Route::prefix('products')->middleware(['auth'])->group(function(){
    Route::post('/updatestok/{id}', [AdminController::class, 'updateStok'])->name('product.stok.update');
    Route::post('/create', [AdminController::class, 'tambahProduk'])->name('product.create');
    Route::post('/edit/{id}', [AdminController::class, 'editProduk'])->name('product.edit');
    Route::post('/delete/{id}', [AdminController::class, 'hapusProduk'])->name('product.delete');
});


Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.statistik');
});

Route::prefix('petani')->middleware(['auth'])->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('petani.statistik');
    Route::post('/konfirmasi/{id}', [AdminController::class, 'konfirmasiPesanan'])->name('petani.konfirmasi');
});