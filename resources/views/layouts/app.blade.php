<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasirOnlen</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-soft-blue">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container-fluid">
            <a href="/" class="navbar-brand logo">
                <img src="{{ asset('assets/images/logo.png') }}"> KasirOnlen
            </a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto gap-2">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link px-4">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="/menu" class="nav-link px-4">Menu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    @yield('content')

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>