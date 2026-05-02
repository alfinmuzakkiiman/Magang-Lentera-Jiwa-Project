<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <title>Edit Menu</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="bg-soft-blue">

    <!-- NAVBAR (SAMA SEPERTI INDEX) -->
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
                        <a href="/dashboard" class="nav-link px-4">
                            <i class="bx bxs-dashboard"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/menu" class="nav-link px-4 active">
                            <i class="bx bx-food-menu"></i> Menu
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link px-4">
                            <i class="bx bx-money"></i> Pendapatan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link px-4">
                            <i class="bx bx-user-pin"></i> Kasir
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Muhammad Yunus Almeida
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="#">Setting</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Log Out</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <section class="container-fluid py-5 px-1 px-lg-5">
        <div class="flex-centerbetween mb-4">
            <h2 class="text-dark fw-bold mb-0">Edit Menu</h2>
        </div>

        <div class="card border-0">
            <div class="card-body">

                <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- NAMA MENU -->
                    <div class="mb-3">
                        <label>Nama Menu</label>
                        <input type="text" name="nama_menu" class="form-control"
                            value="{{ $menu->nama_menu }}" required>
                    </div>

                    <!-- KATEGORI -->
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="Makanan" {{ $menu->kategori == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="Minuman" {{ $menu->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="Snack" {{ $menu->kategori == 'Snack' ? 'selected' : '' }}>Snack</option>
                        </select>
                    </div>

                    <!-- HARGA -->
                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control"
                            value="{{ $menu->harga }}" required>
                    </div>

                    <!-- GAMBAR -->
                    <div class="mb-3">
                        <label>Gambar (opsional)</label>
                        <input type="file" name="gambar" class="form-control">

                        @if($menu->gambar)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$menu->gambar) }}" width="80" class="rounded">
                            </div>
                        @endif
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">
                            <i class="bx bx-save"></i> Update
                        </button>

                        <a href="/menu" class="btn btn-light">
                            <i class="bx bx-arrow-back"></i> Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="pt-5 pb-4">
        <div class="container">
            <p class="mb-0 text-center text-secondary fs-7">
                Copyright &copy; PT Onlenkan Teknologi Indonesia 2024.
            </p>
        </div>
    </footer>

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>