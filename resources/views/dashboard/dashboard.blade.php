<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>Dashboard</title>

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-soft-blue">
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container-fluid">
            <a href="." class="navbar-brand logo">
                <img src="assets/images/logo.png" alt=""> KasirOnlen
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto gap-2">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link px-4 active">
                            <i class="bx bxs-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('menu.index') }}" class="nav-link px-4">
                            <i class="bx bx-food-menu"></i> Menu
                        </a>                     
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pendapatan.index') }}" class="nav-link px-4">
                            <i class="bx bx-money"></i> Pendapatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kasir.index') }}" class="nav-link px-4">
                            <i class="bx bx-user-pin"></i> Kasir
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}">Setting</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container-fluid py-5 px-1 px-lg-5">
        @php
            $hour = now()->timezone('Asia/Jakarta')->format('H');
            if ($hour < 11) { $waktu = 'pagi'; }
            elseif ($hour < 15) { $waktu = 'siang'; }
            elseif ($hour < 18) { $waktu = 'sore'; }
            else { $waktu = 'malam'; }
        @endphp
        <div class="row g-4">
            <h2 class="text-dark fw-bold mb-4">Selamat {{ $waktu }} {{ auth()->user()->name }}</h2>
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-4">
                        <i class='bx bxs-food-menu fs-1 text-primary'></i>
                        <h4 class="text-dark mb-0 mt-3">{{ $totalMenu }} Menu</h4>
                        <p class="text-secondary mb-0">Jumlah Menu Yang Ada</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-4">
                        <i class='bx bx-money fs-1 text-primary'></i>
                        <h4 class="text-dark mb-0 mt-3">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                        <p class="text-secondary mb-0">Pendapatan Hari Ini</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-4">
                        <i class='bx bx-male-female fs-1 text-primary'></i>
                        <h4 class="text-dark mb-0 mt-3">{{ $totalOrder }} Order</h4>
                        <p class="text-secondary mb-0">Order Hari Ini</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-4">
                        <i class='bx bxs-user-pin fs-1 text-primary'></i>
                        <h4 class="text-dark mb-0 mt-3">{{ $totalKasir }} Kasir</h4>
                        <p class="text-secondary mb-0">Jumlah Kasir</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-5 pb-4">
        <div class="container">
            <p class="mb-0 text-center text-secondary fs-7">
                Copyright &copy; PT Onlenkan Teknologi Indonesia 2024. Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>

    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
