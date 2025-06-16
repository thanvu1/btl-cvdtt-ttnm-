<?php

use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('Customer.index'); // Trang chủ công khai, không cần đăng nhập
});

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
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
