@extends('layouts.guest-app')
@section('content')
<a href="{{ route('home') }}" class="btn btn-link px-0">← Kembali ke jadwal</a>
<div class="card"><div class="card-body">
    <h3>{{ $schedule->bus->bus_name }} - {{ $schedule->bus->bus_type }}</h3>
    <h5>{{ $schedule->route->originTerminal->city }} → {{ $schedule->route->destinationTerminal->city }}</h5>
    <p>Berangkat: {{ $schedule->departure_time->format('d M Y H:i') }} WIB</p>
    <p>Tiba: {{ $schedule->arrival_time->format('d M Y H:i') }} WIB</p>
    <p>Harga per kursi: <strong>Rp {{ number_format($schedule->price, 0, ',', '.') }}</strong></p>
    @auth
    <form method="POST" action="{{ route('bookings.store', $schedule) }}">
        @csrf
        <h5>Pilih kursi (maksimal 6)</h5>
        <div class="row">
        @foreach($schedule->bus->seats as $seat)
            <div class="col-4 col-md-2 mb-2">
                <label class="border rounded p-2 d-block text-center {{ in_array($seat->id, $bookedSeatIds) ? 'bg-secondary text-white' : 'bg-light' }}">
                    <input type="checkbox" name="seats[]" value="{{ $seat->id }}" {{ in_array($seat->id, $bookedSeatIds) ? 'disabled' : '' }}>
                    {{ $seat->seat_number }}
                    @if(in_array($seat->id, $bookedSeatIds)) <small>(Terisi)</small> @endif
                </label>
            </div>
        @endforeach
        </div>
        <button class="btn btn-success mt-3">Pesan Tiket</button>
    </form>
    @else
        <div class="alert alert-warning">Silakan <a href="{{ route('login') }}">login</a> untuk memesan tiket.</div>
    @endauth
</div></div>
@endsection
