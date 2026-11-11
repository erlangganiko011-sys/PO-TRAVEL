@extends('layouts.guest-app')
@section('content')
<h3>Dashboard Admin</h3>
<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="card card-body"><small>Total Bus</small><h2>{{ $busCount }}</h2></div></div>
    <div class="col-md-4"><div class="card card-body"><small>Total Jadwal</small><h2>{{ $scheduleCount }}</h2></div></div>
    <div class="col-md-4"><div class="card card-body"><small>Total Booking</small><h2>{{ $bookingCount }}</h2></div></div>
</div>
<h5>Pesanan Terbaru</h5>
<div class="table-responsive"><table class="table table-striped">
<thead><tr><th>Kode</th><th>Pengguna</th><th>Jadwal</th><th>Status</th><th>Total</th></tr></thead>
<tbody>@forelse($recentBookings as $booking)
<tr><td>{{ $booking->booking_code }}</td><td>{{ $booking->user->name }}</td><td>#{{ $booking->schedule_id }}</td><td>{{ $booking->status }}</td><td>Rp {{ number_format($booking->total_price,0,',','.') }}</td></tr>
@empty<tr><td colspan="5">Belum ada booking.</td></tr>@endforelse</tbody>
</table></div>
@endsection
