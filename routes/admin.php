<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SlideController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'getViewLogin'])->name('login-page');


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('product', [ProductController::class, 'index'])->name('products.index');
Route::get('order', [OrderController::class, 'index'])->name('orders.index');
Route::get('category', [CategoryController::class, 'index'])->name('category.index');
Route::get('manager', [ManagerController::class, 'index'])->name('manager.index');
Route::get('slide', [SlideController::class, 'index'])->name('sldie.index');
Route::get('member', [MemberController::class, 'index'])->name('member.index');