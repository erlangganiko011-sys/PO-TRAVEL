<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PO CAN Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">PO CAN Travel</a>
        <div class="ms-auto d-flex gap-2 align-items-center">
            @auth
                <a class="btn btn-sm btn-outline-light" href="{{ route('bookings.index') }}">Pesanan Saya</a>
                <span class="text-white">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-sm btn-light">Logout</button></form>
            @else
                <a class="btn btn-sm btn-outline-light" href="{{ route('login') }}">Login</a>
                <a class="btn btn-sm btn-light" href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>
</nav>
<main class="container py-4">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if($errors->any()) <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div> @endif
    @yield('content')
</main>
</body>
</html>
