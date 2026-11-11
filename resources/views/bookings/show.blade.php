@extends('layouts.guest-app')
@section('content')
<h3>Detail Pemesanan</h3>
<div class="card"><div class="card-body">
    <h5>{{ $booking->booking_code }}</h5>
    <p>Status: <strong>{{ strtoupper($booking->status) }}</strong></p>
    <p>Bus: {{ $booking->schedule->bus->bus_name }}</p>
    <p>Rute: {{ $booking->schedule->route->originTerminal->city }} → {{ $booking->schedule->route->destinationTerminal->city }}</p>
    <p>Keberangkatan: {{ $booking->schedule->departure_time->format('d M Y H:i') }}</p>
    <p>Kursi: {{ $booking->details->pluck('seat.seat_number')->join(', ') }}</p>
    <h5>Total: Rp {{ number_format($booking->total_price, 0, ',', '.') }}</h5>
    <div class="alert alert-warning mb-0">Status masih pending. Integrasi pembayaran belum diaktifkan pada starter ini.</div>
</div></div>
@endsection
