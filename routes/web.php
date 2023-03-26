<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('authenticate');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/', HomeController::class)->name('dashboard');
    Route::get('/stores', StoreController::class)->name('store');
    Route::resource('brands', BrandController::class)->except(['show']);
    Route::resource('products', ProductController::class);
    Route::resource('colors', ColorController::class)->except(['show']);
    Route::resource('incomes', IncomeController::class)->except(['show']);
    Route::resource('expenditures', ExpenditureController::class)->except(['show']);
});
