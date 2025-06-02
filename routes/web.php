<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\IsAdmin;

// Trang welcome (mặc định)
Route::get('/', fn () => view('welcome'))->name('welcome');

// Dashboard redirect (cần đăng nhập + xác thực email)
Route::get('/dashboard', fn () => redirect()->route('home.homepage'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Trang chính (Home)
Route::get('/home', fn () => view('home.homepage'))->name('home.homepage');

// Trang liên hệ (Contact)
Route::get('/contact', fn () => view('contact.index'))->name('contact');

// =======================
// Quản lý Giỏ hàng (Cart)
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{carId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Hiển thị form checkout (gửi yêu cầu tư vấn)

    Route::get('/cart/checkout', [CartController::class, 'showCheckoutForm'])->name('cart.checkout.form');

    // Xử lý submit form checkout gửi mail
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout.submit');
});

// =======================
// Quản lý Xe (Cars)
// =======================

// Các route cần phân quyền Admin
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});

// Các route ai cũng xem được (Danh sách + Chi tiết)
Route::resource('cars', CarController::class)->only(['index', 'show']);

// Đặt lịch
Route::get('/schedule', [ScheduleController::class, 'showForm'])->name('schedule.form');
Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');

// =======================
// Quản lý Profile Người dùng
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =======================
// Auth routes (Laravel Breeze / Fortify / Jetstream)
// =======================
require __DIR__.'/auth.php';
