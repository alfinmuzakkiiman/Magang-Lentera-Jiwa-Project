<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <title>Dashboard Kategori</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-soft-blue">
    <!-- NAVBAR (Copied from Menu) -->
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
                    @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link px-4">
                            <i class="bx bxs-dashboard"></i> Dashboard
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->role === 'kitchen')
                    <li class="nav-item">
                        <a href="{{ route('kitchen.index') }}" class="nav-link px-4">
                            <i class="bx bx-home"></i> Beranda Dapur
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('menu.index') }}" class="nav-link px-4">
                            <i class="bx bx-food-menu"></i> Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}" class="nav-link px-4 active">
                            <i class="bx bx-category"></i> Kategori
                        </a>
                    </li>
                    @if(auth()->user()->role === 'admin')
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
                    @endif
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
        <div class="flex-centerbetween mb-4">
            <h2 class="text-dark fw-bold mb-0">Kelola Kategori</h2>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Tambah Kategori
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($kategoris as $key => $kategori)
                            <tr class="align-middle">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                                           class="btn btn-warning btn-sm py-1 px-3 rounded-1 text-white">
                                            <i class="bx bx-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-light btn-sm py-1 px-3 rounded-1"
                                                onclick="return confirm('Yakin hapus?')">
                                                <i class="bx bx-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <i class="bx bx-category" style="font-size:40px;"></i>
                                    <p class="mt-2 text-muted">Belum ada kategori</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
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
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
