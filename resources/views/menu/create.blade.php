<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
    <title>Tambah Menu</title>

    <!-- FIX CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="bg-soft-blue">

    <!-- NAVBAR (tidak diubah desain) -->
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container-fluid">
            <a href="/" class="navbar-brand logo">
                <img src="{{ asset('assets/images/logo.png') }}"> KasirOnlen
            </a>
        </div>
    </nav>

    <!-- CONTENT -->
    <section class="container-fluid py-5 px-1 px-lg-5">
        <div class="flex-centerbetween mb-4">
            <h2 class="text-dark fw-bold mb-0">Tambah Menu</h2>
        </div>

        <div class="card border-0">
            <div class="card-body">

                <!-- FORM FIX -->
                <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Nama Menu</label>
                        <input type="text" name="nama_menu" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Snack">Snack</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">
                            <i class="bx bx-save"></i> Simpan
                        </button>

                        <a href="{{ route('menu.index') }}" class="btn btn-light">
                            <i class="bx bx-arrow-back"></i> Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </section>

    <footer class="pt-5 pb-4">
        <div class="container text-center">
            <small class="text-secondary">© 2024</small>
        </div>
    </footer>

    <!-- FIX JS -->
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>