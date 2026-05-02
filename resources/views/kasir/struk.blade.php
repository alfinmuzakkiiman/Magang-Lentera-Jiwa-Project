<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <title>Transaksi Sukses</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <style>
        /* CSS untuk Auto Print - Sembunyikan tombol saat di-print */
        @media print {
            .btn {
                display: none !important;
            }
            body {
                background-color: white !important;
            }
            .card {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
</head>

<body class="bg-soft-blue">
    <section class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card border-0">
                    <div class="card-body py-5 px-5">
                        <div class="bg-soft-blue rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 60px; height: 60px">
                            <i class='bx bx-check text-primary fs-1'></i>
                        </div>
                        <h5 class="text-center fw-semibold mb-4">Transaksi Sukses</h5>

                        <p class="mb-1 text-secondary text-uppercase fw-medium fs-7">Detail Produk</p>
                        
                        {{-- Loop Data dari Database --}}
                        @foreach($trx->details as $item)
                        <div class="row mt-2">
                            <div class="col-7">
                                <p class="mb-0 text-dark fw-semibold">{{ $item->menu->nama_menu }}</p>
                                <p class="mb-0 text-secondary fs-7">Rp. {{ number_format($item->harga) }}</p>
                            </div>
                            <div class="col-5">
                                <p class="mb-0 text-dark text-end fw-semibold">Rp. {{ number_format($item->subtotal) }}</p>
                                <p class="mb-0 text-secondary text-end fs-7">{{ $item->qty }}x</p>
                            </div>
                        </div>
                        @endforeach

                        <hr class="my-4" style="border-style: dashed;">
                        
                        @php
                            $subtotal = $trx->total / 1.11; // subtotal sebelum pajak
                            $pajak = $trx->total - $subtotal;
                        @endphp
                        
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Subtotal</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format(round($subtotal)) }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Pajak (11%)</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format(round($pajak)) }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Total</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($trx->total) }}</p>
                        </div>
                        
                        <hr class="my-4" style="border-style: dashed;">
                        
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Cash</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($trx->cash) }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <p class="mb-0 text-secondary">Kembali</p>
                            <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($trx->kembalian) }}</p>
                        </div>

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('pendapatan.index') }}" class="btn btn-primary d-block mt-5">Kembali</a>
                        @else
                            <a href="{{ route('kasir.index') }}" class="btn btn-primary d-block mt-5">Kembali</a>
                        @endif
                        <button onclick="window.print()" class="btn btn-outline-secondary d-block w-100 mt-2">Cetak Struk</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Auto print begitu halaman dimuat
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500); // delay dikit biar icon keload
        }
    </script>
</body>

</html>
