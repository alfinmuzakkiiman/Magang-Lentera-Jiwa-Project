<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>Dashboard Pendapatan</title>

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
                        <a href="{{ route('pendapatan.index') }}" class="nav-link px-4 active">
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

    <section class="container-fluid py-5 px-0 px-lg-5">
        <div class="d-flex align-items-center justify-content-between mb-4 px-3 px-lg-0">
            <h2 class="text-dark fw-bold mb-0">Pendapatan</h2>
            <form action="{{ route('pendapatan.index') }}" method="GET" class="d-flex gap-2">
                <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}">
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
        <div class="card border-0 mx-3 mx-lg-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Pesanan</th>
                                <th>Nama Kasir</th>
                                <th>Nama Pelanggan</th>
                                <th>Item</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr class="align-middle">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->kode_pesanan }}</td>
                                <td>{{ $item->nama_kasir }}</td>
                                <td>{{ $item->nama_pelanggan }}</td>
                                <td>{{ $item->item }} Item</td>
                                <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-primary btn-sm py-1 px-3 rounded-1"
                                            data-bs-toggle="modal" data-bs-target="#detail-{{ $item->id }}">
                                            <i class="bx bx-info-circle"></i> Detail Pesanan
                                        </button>
                                        <a href="{{ route('admin.struk', $item->id) }}" target="_blank" class="btn btn-success btn-sm py-1 px-3 rounded-1">
                                            <i class="bx bx-printer"></i> Cetak
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-secondary py-4">Belum ada data pendapatan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end">Total</td>
                                <td class="fw-semibold text-success">Rp. {{ number_format($grandTotal ?? 0, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        @foreach($data as $item)
        <div class="modal fade" id="detail-{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Detail Pesanan</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-1 text-secondary text-uppercase fw-medium fs-7">Detail Produk</p>
                        
                        @foreach($item->details as $detail)
                        <div class="row mt-2">
                            <div class="col-7">
                                <p class="mb-0 text-dark fw-semibold">{{ $detail->menu->nama_menu ?? 'Produk Dihapus' }}</p>
                                <p class="mb-0 text-secondary fs-7">Rp. {{ number_format($detail->harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-5">
                                <p class="mb-0 text-dark text-end fw-semibold">Rp. {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                <p class="mb-0 text-secondary text-end fs-7">{{ $detail->qty }}x</p>
                            </div>
                        </div>
                        @endforeach

                        <hr class="my-4" style="border-style: dashed;">
                        @php
                            $subtotal_pesanan = $item->details->sum('subtotal');
                            $pajak_pesanan = round($subtotal_pesanan * 0.11);
                        @endphp
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Subtotal</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($subtotal_pesanan, 0, ',', '.') }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Pajak (11%)</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($pajak_pesanan, 0, ',', '.') }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Total</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($item->total, 0, ',', '.') }}</p>
                        </div>
                        <hr class="my-4" style="border-style: dashed;">
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Cash</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($item->cash, 0, ',', '.') }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Kembali</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($item->kembalian, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
