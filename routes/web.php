<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ScheduleController::class, 'index'])->name('home');
Route::get('/jadwal/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');

Route::middleware('auth')->group(function () {
    Route::post('/jadwal/{schedule}/pesan', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/pesanan', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/pesanan/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
