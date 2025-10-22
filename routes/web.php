<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFlightController;
use App\Http\Controllers\Admin\AdminBookingController;

// ==================== ROUTES CÔNG KHAI ====================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tìm kiếm chuyến bay (không cần đăng nhập)
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flights/{id}', [FlightController::class, 'show'])->name('flights.show');

// ==================== ROUTES USER (Cần đăng nhập) ====================
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        // Nếu là admin → chuyển đến admin dashboard
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        // Nếu là user → hiển thị dashboard user
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Bookings (Đặt vé)
    Route::get('/bookings/create/{flight}', [BookingController::class, 'create'])->name('bookings.create');
    Route::resource('bookings', BookingController::class)->except(['create']);

    // Payments (Thanh toán)
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index'); 
    Route::get('/payments/create/{booking}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
});

// ==================== ROUTES ADMIN (Cần đăng nhập + role = admin) ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Quản lý Flights (CRUD đầy đủ)
    Route::resource('flights', AdminFlightController::class);

    // Quản lý Airports (nếu cần)
    // Route::resource('airports', AdminAirportController::class);

    // Quản lý Bookings
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    // Quản lý Users (nếu cần)
    // Route::resource('users', AdminUserController::class);
});

// ==================== AUTH ROUTES ====================
require __DIR__.'/auth.php';

// ==================== FALLBACK ====================
Route::fallback(function () {
    return redirect()->route('home');
});