<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Schedule;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'busCount' => Bus::count(),
            'scheduleCount' => Schedule::count(),
            'bookingCount' => Booking::count(),
            'recentBookings' => Booking::with('user', 'schedule')->latest()->take(10)->get(),
        ]);
    }
}
