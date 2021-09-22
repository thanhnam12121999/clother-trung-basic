<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\PaymentController;

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

Route::get('', function () {
   return redirect()->route('home');
});

Route::get('trang-chu', [HomeController::class, 'index'])->name('home');
Route::prefix('san-pham')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('products.index');
    Route::get('chi-tiet', [ProductController::class, 'detail'])->name('products.detail');
});
Route::get('gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::get('thanh-toan', [PaymentController::class, 'index'])->name('payment.index');
