<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CetakController;


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

Route::get('/', function () {
    return view('dashboard',[
        "title"=>"Dashboard"
    ]);
})->middleware('auth');
Route::resource('kategori',CategoryController::class)
->except('show','destroy','create');
Route::resource('pelanggan',CustomerController::class)->except('destroy');
Route::resource('produk',ProductController::class);
Route::resource('pengguna',UserController::class)->except('destroy','create','show','update','edit',);
Route::get('login',[LoginController::class,'loginView'])->name('login');
Route::post('login',[LoginController::class,'authenticate']); 
Route::post('logout',[LoginController::class,'logout'])->middleware('auth');

Route::get('penjualan',function(){
    return view('penjualan.index',[
        "title"=>"Penjualan"
    ]);
})->middleware('auth');

Route::get('order',function(){
    return view('penjualan.orders',[
        "title"=>"Order"
    ]);
    })->middleware('auth');
    Route::get('cetakReceipt',[CetakController::class,'receipt'])->name('cetakReceipt')->middleware('auth');
