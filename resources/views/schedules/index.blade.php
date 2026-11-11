@extends('layouts.guest-app')
@section('content')
<h3 class="mb-3">Cari Jadwal Bus</h3>
<form class="card card-body mb-4" method="GET" action="{{ route('home') }}">
    <div class="row g-2">
        <div class="col-md-4"><label class="form-label">Kota asal</label><input class="form-control" name="origin" value="{{ request('origin') }}" placeholder="Contoh: Semarang"></div>
        <div class="col-md-4"><label class="form-label">Kota tujuan</label><input class="form-control" name="destination" value="{{ request('destination') }}" placeholder="Contoh: Yogyakarta"></div>
        <div class="col-md-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="date" min="{{ now()->toDateString() }}" value="{{ request('date') }}"></div>
        <div class="col-md-1 d-flex align-items-end"><button class="btn btn-primary w-100">Cari</button></div>
    </div>
</form>
<div class="row g-3">
@forelse($schedules as $schedule)
    <div class="col-md-6">
        <div class="card h-100 shadow-sm"><div class="card-body">
            <div class="d-flex justify-content-between"><h5>{{ $schedule->bus->bus_name }}</h5><span class="badge bg-success">{{ $schedule->bus->bus_type }}</span></div>
            <p class="mb-1">{{ $schedule->route->originTerminal->city }} → {{ $schedule->route->destinationTerminal->city }}</p>
            <p class="text-muted mb-1">{{ $schedule->departure_time->format('d M Y, H:i') }} WIB</p>
            <h5 class="text-primary">Rp {{ number_format($schedule->price, 0, ',', '.') }}</h5>
            <a class="btn btn-primary" href="{{ route('schedules.show', $schedule) }}">Lihat jadwal & kursi</a>
        </div></div>
    </div>
@empty
    <div class="col-12"><div class="alert alert-info">Belum ada jadwal yang cocok.</div></div>
@endforelse
</div>
<div class="mt-3">{{ $schedules->links() }}</div>
@endsection
