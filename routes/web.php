<?php

use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

Route::get('/', [ProductController::class, 'index'])
    ->name('home');

Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Route nhóm middleware auth
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', function () {
        return view('Admin.index');
    })->name('Admin.home');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('discount-codes', DiscountCodeController::class);
        // Khi đó:
        // admin/discount-codes        -> danh sách
        // admin/discount-codes/create -> form thêm mới
        // admin/discount-codes/{id}/edit -> sửa
        // admin/discount-codes/{id}   -> show (nếu dùng)
    });

    Route::get('/customer', function () {
        return view('Customer.index');
    })->name('Customer.home');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');


Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::prefix('admin/products')->name('admin.products.')->group(function () {
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('', [ProductController::class, 'store'])->name('store');
});
Route::get('admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');

require __DIR__.'/auth.php';
