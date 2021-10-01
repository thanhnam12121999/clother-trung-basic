<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\AuthController;

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

Route::get('dang-nhap', [AuthController::class, 'signIn'])->name('auth.sign-in');
Route::post('login', [AuthController::class, 'doLogin'])->name('auth.login');
Route::get('dang-ky', [AuthController::class, 'signUp'])->name('auth.sign-up');
Route::post('register', [AuthController::class, 'doRegister'])->name('auth.register');
Route::get('dang-xuat', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('', function () {
    return redirect()->route('home');
});

Route::get('trang-chu', [HomeController::class, 'index'])->name('home');
Route::prefix('san-pham')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{slug}', [ProductController::class, 'detail'])->name('products.detail');
});
Route::get('gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add/{slug}', [CartController::class, 'add'])->name('cart.add');
Route::get('cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('thanh-toan', [PaymentController::class, 'index'])->name('payment.index');
