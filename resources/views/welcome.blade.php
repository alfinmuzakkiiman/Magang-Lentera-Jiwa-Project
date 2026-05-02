<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-soft-blue">
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container-fluid">
            <a href="." class="navbar-brand logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt=""> KasirOnlen
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto gap-2">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link active px-4">
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
                            Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="#">Setting</a></li>
                            <li><hr class="dropdown-divider"></li>
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
        <h2 class="text-dark fw-bold mb-4">Dashboard Overview</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <i class="bx bx-money text-success fs-1 mb-2"></i>
                    <p class="text-secondary mb-1">Total Pendapatan</p>
                    <h3 class="fw-bold">Rp. {{ number_format($total_pendapatan ?? 0) }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <i class="bx bx-cart text-primary fs-1 mb-2"></i>
                    <p class="text-secondary mb-1">Total Transaksi</p>
                    <h3 class="fw-bold">{{ $count_pendapatan ?? 0 }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <i class="bx bx-food-menu text-warning fs-1 mb-2"></i>
                    <p class="text-secondary mb-1">Total Menu</p>
                    <h3 class="fw-bold">{{ $count_menu ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>