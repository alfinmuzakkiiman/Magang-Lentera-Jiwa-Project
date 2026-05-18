<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-soft-blue">
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container-fluid">
            <a href="/" class="navbar-brand logo">
                <img src="{{ asset('assets/images/logo.png') }}"> KasirOnlen
            </a>
        </div>
    </nav>
    <section class="container-fluid py-5 px-1 px-lg-5">
        <div class="flex-centerbetween mb-4">
            <h2 class="text-dark fw-bold mb-0">Tambah Kategori</h2>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">
                            <i class="bx bx-save"></i> Simpan
                        </button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-light">
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
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
