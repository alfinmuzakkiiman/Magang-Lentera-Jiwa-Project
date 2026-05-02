<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <title>Dashboard Kasir</title>

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
                        <a href="{{ route('dashboard') }}" class="nav-link px-4">
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
                        <a href="{{ route('admin.kasir.index') }}" class="nav-link px-4 active">
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

    <section class="container-fluid py-5 px-0 px-lg-5">
        <div class="d-flex align-items-center justify-content-between mb-4 px-3 px-lg-0">
            <h2 class="text-dark fw-bold mb-0">Kasir</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKasirModal">
                <i class="bx bx-plus"></i> Tambah Kasir
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success mx-3 mx-lg-0">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mx-3 mx-lg-0">{{ $errors->first() }}</div>
        @endif

        <div class="card border-0 mx-3 mx-lg-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Total Penjualan</th>
                                <th>Pendapatan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kasirs as $index => $k)
                            <tr class="align-middle">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $k->name }}</td>
                                <td>{{ $k->email }}</td>
                                <td>{{ $k->pendapatans_count }} Penjualan</td>
                                <td class="text-success fw-bold">Rp. {{ number_format($k->pendapatans_sum_total ?? 0) }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-warning btn-sm py-1 px-3 rounded-1 text-white" data-bs-toggle="modal" data-bs-target="#editKasirModal-{{ $k->id }}">
                                            <i class="bx bx-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('admin.kasir.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun kasir ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light btn-sm py-1 px-3 rounded-1">
                                                <i class="bx bx-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Kasir -->
                            <div class="modal fade" id="editKasirModal-{{ $k->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.kasir.update', $k->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title fw-bold">Edit Akun Kasir</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $k->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $k->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Password Baru <small class="text-secondary">(Kosongkan jika tidak ingin mengubah password)</small></label>
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-secondary">Belum ada akun kasir.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Tambah Kasir -->
    <div class="modal fade" id="addKasirModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.kasir.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">Tambah Akun Kasir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Kasir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
