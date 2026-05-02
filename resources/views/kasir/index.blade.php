<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>Halaman Depan</title>

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
                   
                </ul>
                <ul class="navbar-nav ms-auto">
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

    <section class="container-fluid py-5 px-0 px-md-5">
        @php
            $hour = now()->timezone('Asia/Jakarta')->format('H');
            if ($hour < 11) { $waktu = 'pagi'; }
            elseif ($hour < 15) { $waktu = 'siang'; }
            elseif ($hour < 18) { $waktu = 'sore'; }
            else { $waktu = 'malam'; }
        @endphp
        <div class="row g-4">
            <div class="col-md-7">
                <h2 class="text-dark fw-bold mb-4">Selamat {{ $waktu }} {{ auth()->user()->name }}</h2>

                <ul class="nav nav-pills gap-1 pb-3 mb-4 border-bottom" id="kategoriTab">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" data-kategori="semua">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-kategori="Makanan">Makanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-kategori="Minuman">Minuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-kategori="Snack">Snack</a>
                    </li>
                </ul>

                <div class="row g-3">
                    @foreach($menus as $menu)
                    <div class="col-6 col-lg-4 menu-item" data-kategori="{{ $menu->kategori }}">
                        <form action="{{ route('kasir.add', $menu->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="border-0 bg-transparent p-0 w-100 text-start">
                                <div class="card" style="cursor: pointer;">
                                    <div class="card-body p-4">
                                        @if($menu->gambar)
                                            <img src="{{ asset('storage/'.$menu->gambar) }}" class="w-75 d-block mx-auto" alt="{{ $menu->nama_menu }}">
                                        @else
                                            <div class="w-75 d-block mx-auto bg-light rounded d-flex align-items-center justify-content-center" style="height:80px;">
                                                <i class="bx bx-food-menu" style="font-size:35px;color:#ccc;"></i>
                                            </div>
                                        @endif
                                        <h4 class="card-title mt-4 mb-2">{{ $menu->nama_menu }}</h4>
                                        <div
                                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-1">
                                            <p class="mb-0 text-secondary fs-7">{{ $menu->kategori }}</p>
                                            <p class="mb-0 text-primary fw-semibold">Rp. {{ number_format($menu->harga) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-5">
                <div class="card border-0">
                    <div class="card-body px-4">
                        <h4 class="text-dark fw-semibold mb-3">Order {{ $kode_pesanan }}</h4>

                        @if(count($cart) > 0)
                            @foreach($cart as $id => $item)
                            <div class="row align-items-center g-3 mt-3">
                                <div class="col-3 col-lg-2">
                                    @if(isset($item['gambar']) && $item['gambar'])
                                        <img src="{{ asset('storage/'.$item['gambar']) }}" alt="" class="rounded-2">
                                    @else
                                        <div class="rounded-2 bg-light d-flex align-items-center justify-content-center" style="height:50px;">
                                            <i class="bx bx-food-menu" style="color:#ccc;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-9 col-lg-4">
                                    <p class="mb-0 fw-semibold text-dark">{{ $item['nama'] }}</p>
                                    <p class="mb-0 fw-semibold text-secondary fs-7">Rp. {{ number_format($item['harga']) }}</p>
                                </div>
                                <div class="col-4 col-lg-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <form action="{{ route('kasir.update', $id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="minus">
                                            <button type="submit" class="btn btn-sm btn-quantity rounded-circle">
                                                <i class="bx bx-minus"></i>
                                            </button>
                                        </form>
                                        <p class="mb-0 text-dark">
                                            {{ $item['qty'] }}
                                        </p>
                                        <form action="{{ route('kasir.update', $id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="plus">
                                            <button type="submit" class="btn btn-sm btn-quantity rounded-circle">
                                                <i class="bx bx-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <p class="mb-0 text-dark fw-bold text-end">Rp. {{ number_format($item['harga'] * $item['qty']) }}</p>
                                </div>
                                <div class="col-2 col-lg-1">
                                    <form action="{{ route('kasir.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-light btn-delete" type="submit"><i
                                                class="bx bx-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-5 text-muted">
                                <i class="bx bx-cart" style="font-size:40px;"></i>
                                <p class="mt-2 mb-0">Keranjang kosong</p>
                            </div>
                        @endif

                        <hr class="mt-5 mb-4">

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <p class="mb-0 text-secondary">Subtotal</p>
                            <p class="mb-0 text-dark fw-bold">Rp. {{ number_format($subtotal) }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 text-secondary">Pajak (11%)</p>
                            <p class="mb-0 text-dark fw-bold">Rp. {{ number_format($pajak) }}</p>
                        </div>

                        <hr class="my-4" style="border-style: dashed;">

                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <p class="mb-0 text-secondary">Total</p>
                            <p class="mb-0 text-dark fw-bold fs-5">Rp. {{ number_format($total) }}</p>
                        </div>

                        <button class="btn btn-primary rounded-3 d-block py-3 w-100" type="button"
                            data-bs-toggle="modal" data-bs-target="#checkoutModal">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="checkoutModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Checkout</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kasir.checkout') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="customer_name"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" name="nama_pelanggan" aria-describedby="customer_name" id="name">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="nominalInput">Rp.</span>
                                <input type="text" class="form-control" value="{{ number_format($total) }}" aria-describedby="nominalInput"
                                    oninput="formatNumber(this)">
                            </div>

                            <input type="hidden" name="cash" id="nominal" value="{{ $total }}">
                            <button class="btn btn-primary w-100" type="submit">Proses</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Struk (muncul otomatis setelah checkout) --}}
        @if(session('struk'))
        @php $struk = session('struk'); @endphp
        <div class="modal fade" id="strukModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Detail Pesanan</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="strukContent">
                        <p class="mb-1 text-secondary text-uppercase fw-medium fs-7">Detail Produk</p>

                        @foreach($struk['items'] as $item)
                        <div class="row mt-2">
                            <div class="col-7">
                                <p class="mb-0 text-dark fw-semibold">{{ $item['nama'] }}</p>
                                <p class="mb-0 text-secondary fs-7">Rp. {{ number_format($item['harga']) }}</p>
                            </div>
                            <div class="col-5">
                                <p class="mb-0 text-dark text-end fw-semibold">Rp. {{ number_format($item['subtotal']) }}</p>
                                <p class="mb-0 text-secondary text-end fs-7">{{ $item['qty'] }}x</p>
                            </div>
                        </div>
                        @endforeach

                        <hr class="my-4" style="border-style: dashed;">
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Subtotal</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($struk['subtotal']) }}</p>
                        </div>

                        <hr class="my-4" style="border-style: dashed;">
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Kasir</p>
                            <p class="mb-0 text-dark fw-semibold">{{ $struk['nama_kasir'] }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Pelanggan</p>
                            <p class="mb-0 text-dark fw-semibold">{{ $struk['nama_pelanggan'] }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Tanggal</p>
                            <p class="mb-0 text-dark fw-semibold">{{ $struk['tanggal'] }}</p>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-success w-100" onclick="window.print()">
                            <i class="bx bx-printer"></i> Cetak Struk
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>

    <footer class="pt-5 pb-4">
        <div class="container">
            <p class="mb-0 text-center text-secondary fs-7">
                Copyright &copy; PT Onlenkan Teknologi Indonesia 2024. Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>

    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('checkoutModal').addEventListener('shown.bs.modal', function () {
            document.getElementById('name').focus();
        });

        function formatNumber(input) {
            // Menghapus karakter non-digit dari nilai input
            let cleanedValue = input.value.replace(/\D/g, '');

            // Memisahkan nilai menjadi bagian ribuan dengan menggunakan regular expression
            cleanedValue = cleanedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Memperbarui nilai input dengan format yang diinginkan
            input.value = cleanedValue;
            document.getElementById('nominal').value = cleanedValue.replace(/,/g, '');
        }

        // Filter kategori
        document.querySelectorAll('#kategoriTab .nav-link').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('#kategoriTab .nav-link').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const kategori = this.dataset.kategori;
                document.querySelectorAll('.menu-item').forEach(item => {
                    if (kategori === 'semua' || item.dataset.kategori === kategori) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Auto-show struk modal setelah checkout
        @if(session('struk'))
        document.addEventListener('DOMContentLoaded', function() {
            var strukModal = new bootstrap.Modal(document.getElementById('strukModal'));
            strukModal.show();
        });
        @endif
    </script>
</body>

</html>
