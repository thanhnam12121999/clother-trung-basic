<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\SlideController;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
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
Route::post('/login-admin', [AuthController::class, 'doLoginAdmin'])->name('login');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('order', [OrderController::class, 'index'])->name('orders.index');
Route::get('slide', [SlideController::class, 'index'])->name('sldie.index')->middleware('policyOfStaff');
Route::get('member', [MemberController::class, 'index'])->name('member.index');

/**
 * Route category
 */
Route::resource('categories', CategoryController::class)->except(['show'])->middleware('policyOfStaff');

Route::prefix('product')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.form_create')->middleware('policyOfStaff');
    Route::post('/create', [ProductController::class, 'store'])->name('products.create')->middleware('policyOfStaff');
    Route::get('/view/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit')->middleware('policyOfStaff');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('policyOfStaff');
    Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete')->middleware('policyOfStaff');
});
// 
Route::group(['prefix' => 'manager', 'middleware' => 'policyOfStaff'], function() {
    Route::get('/', [ManagerController::class, 'index'])->name('manager.index');
    Route::get('/edit/{id}', [ManagerController::class, 'getFormEdit'])->name('managers.edit');
    Route::put('/update/{id}', [ManagerController::class, 'update'])->name('managers.update');
    Route::get('/delete/{id}', [ManagerController::class, 'destroy'])->middleware('policyOfManager')->name('managers.delete');
});

Route::resource('attributes', AttributeController::class)->only(['store', 'update', 'destroy'])->middleware('policyOfStaff');
Route::group(['prefix' => 'variants', 'middleware' => 'policyOfStaff'], function() {
    Route::get('/{product}', [ProductVariantController::class, 'getVariantsOfProduct'])->name('products.variants');
    Route::put('/{product}', [ProductVariantController::class, 'updateProductVariants'])->name('products.variants.update');
});
// Route::get('test', function () {
//    return Hash::make(123456);
// });
