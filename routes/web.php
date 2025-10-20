<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

// --------------------
// Dashboard (yêu cầu đăng nhập & xác minh)
// --------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --------------------
// Profile routes
// --------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Gọi các route mặc định của Laravel Breeze / Jetstream
require __DIR__.'/auth.php';

// --------------------
// Trang chủ & chuyến bay (public)
// --------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flights/{id}', [FlightController::class, 'show'])->name('flights.show');

// --------------------
// Đặt vé & Thanh toán (chỉ khi đã đăng nhập)
// --------------------
Route::middleware('auth')->group(function () {

    // Booking routes
    Route::get('/bookings/create/{flight}', [BookingController::class, 'create'])->name('bookings.create');
    Route::resource('bookings', BookingController::class)->except(['create']);

    // Payment routes
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index'); // ✅ thêm route index
    Route::get('/payments/create/{booking}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
});

// --------------------
// Fallback route
// --------------------
Route::fallback(function () {
    return redirect()->route('home');
});
