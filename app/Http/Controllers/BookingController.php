<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class BookingController extends Controller
{
    public function store(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'seats' => ['required', 'array', 'min:1', 'max:6'],
            'seats.*' => ['required', 'integer', 'distinct', 'exists:seats,id'],
        ]);

        if ($schedule->status !== 'available' || $schedule->departure_time->isPast()) {
            throw ValidationException::withMessages(['seats' => 'Jadwal ini sudah tidak tersedia.']);
        }

        try {
            $booking = DB::transaction(function () use ($validated, $schedule, $request) {
                $freshSchedule = Schedule::whereKey($schedule->id)->lockForUpdate()->firstOrFail();
                $seatIds = collect($validated['seats'])->unique()->values();

                $validSeats = $freshSchedule->bus->seats()
                    ->whereIn('id', $seatIds)->lockForUpdate()->pluck('id');

                if ($validSeats->count() !== $seatIds->count()) {
                    throw ValidationException::withMessages(['seats' => 'Ada kursi yang bukan milik bus pada jadwal ini.']);
                }

                $alreadyBooked = BookingDetail::where('schedule_id', $freshSchedule->id)
                    ->whereIn('seat_id', $seatIds)->exists();

                if ($alreadyBooked) {
                    throw ValidationException::withMessages(['seats' => 'Salah satu kursi baru saja dipesan. Silakan pilih kursi lain.']);
                }

                $total = $freshSchedule->price * $seatIds->count();
                $booking = Booking::create([
                    'user_id' => $request->user()->id,
                    'schedule_id' => $freshSchedule->id,
                    'booking_code' => 'CAN-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
                    'total_price' => $total,
                    'status' => 'pending',
                    'booking_date' => now(),
                ]);

                foreach ($seatIds as $seatId) {
                    $booking->details()->create([
                        'schedule_id' => $freshSchedule->id,
                        'seat_id' => $seatId,
                        'price' => $freshSchedule->price,
                    ]);
                }

                return $booking;
            });

            return redirect()->route('bookings.show', $booking)->with('success', 'Pemesanan berhasil dibuat. Silakan lanjutkan proses pembayaran.');
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'one_seat_per_schedule')) {
                throw ValidationException::withMessages(['seats' => 'Kursi sudah dipesan pengguna lain.']);
            }
            throw $e;
        }
    }

    public function index(Request $request)
    {
        $bookings = Booking::with(['schedule.bus', 'schedule.route.originTerminal', 'schedule.route.destinationTerminal', 'details.seat'])
            ->where('user_id', $request->user()->id)
            ->latest()->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function show(Request $request, Booking $booking)
    {
        abort_unless($booking->user_id === $request->user()->id || $request->user()->role === 'admin', 403);
        $booking->load(['schedule.bus', 'schedule.route.originTerminal', 'schedule.route.destinationTerminal', 'details.seat', 'payments']);
        return view('bookings.show', compact('booking'));
    }
}
