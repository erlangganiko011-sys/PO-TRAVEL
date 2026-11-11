@extends('layouts.guest-app')
@section('content')
<h3>Riwayat Pemesanan Saya</h3>
@forelse($bookings as $booking)
<div class="card mb-3"><div class="card-body">
    <div class="d-flex justify-content-between"><strong>{{ $booking->booking_code }}</strong><span class="badge bg-info text-dark">{{ ucfirst($booking->status) }}</span></div>
    <p class="mb-1">{{ $booking->schedule->route->originTerminal->city }} → {{ $booking->schedule->route->destinationTerminal->city }}</p>
    <p class="mb-1">Kursi: {{ $booking->details->pluck('seat.seat_number')->join(', ') }}</p>
    <p>Total: Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-primary">Detail</a>
</div></div>
@empty
<div class="alert alert-info">Kamu belum memiliki pemesanan.</div>
@endforelse
{{ $bookings->links() }}
@endsection
