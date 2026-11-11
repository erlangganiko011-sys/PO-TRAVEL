<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with(['bus', 'route.originTerminal', 'route.destinationTerminal'])
            ->where('status', 'available')
            ->where('departure_time', '>=', now());

        $request->validate([
            'origin' => ['nullable', 'string', 'max:100'],
            'destination' => ['nullable', 'string', 'max:100'],
            'date' => ['nullable', 'date', 'after_or_equal:today'],
        ]);

        if ($request->filled('origin')) {
            $query->whereHas('route.originTerminal', fn ($q) => $q->where('city', 'like', '%' . $request->origin . '%'));
        }
        if ($request->filled('destination')) {
            $query->whereHas('route.destinationTerminal', fn ($q) => $q->where('city', 'like', '%' . $request->destination . '%'));
        }
        if ($request->filled('date')) {
            $query->whereDate('departure_time', $request->date);
        }

        $schedules = $query->orderBy('departure_time')->paginate(10)->withQueryString();
        return view('schedules.index', compact('schedules'));
    }

    public function show(Schedule $schedule)
    {
        $schedule->load(['bus.seats', 'route.originTerminal', 'route.destinationTerminal']);
        $bookedSeatIds = $schedule->bookingDetails()
            ->whereHas('booking', fn ($q) => $q->whereIn('status', ['pending', 'paid']))
            ->pluck('seat_id')->all();

        return view('schedules.show', compact('schedule', 'bookedSeatIds'));
    }
}
