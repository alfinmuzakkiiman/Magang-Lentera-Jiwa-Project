<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <title>Kitchen - Order List</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="bg-soft-blue">
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container-fluid">
            <a href="/" class="navbar-brand logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt=""> KasirOnlen
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            
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

    <section class="container-fluid py-5 px-1 px-lg-5">
        @php
            $hour = now()->timezone('Asia/Jakarta')->format('H');
            if ($hour < 11) { $waktu = 'pagi'; }
            elseif ($hour < 15) { $waktu = 'siang'; }
            elseif ($hour < 18) { $waktu = 'sore'; }
            else { $waktu = 'malam'; }
        @endphp
        <div class="row g-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h2 class="text-dark fw-bold mb-0">Selamat {{ $waktu }} {{ auth()->user()->name }}</h2>
            </div>
            <p class="text-secondary mb-4">Daftar Orderan Masuk</p>
            
            @forelse($orders as $order)
                <div class="col-6 col-lg-3">
                    <div class="card" type="button" data-bs-toggle="modal" data-bs-target="#changeStatus-{{ $order->id }}">
                        <div class="card-body">
                            <p class="mb-0 text-secondary text-end fs-7">{{ $order->kode_pesanan }}</p>
                            <h5 class="text-dark mb-0">{{ $order->nama_pelanggan }}</h5>
                            <p class="mb-2 text-secondary fs-8">
                                {{ $order->item }} Items
                            </p>
                            
                            @if($order->status == 'Completed')
                                <span class="badge bg-primary">Completed</span>
                            @else
                                <span class="badge bg-warning">Waiting</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Modal Update Status untuk setiap order --}}
                <div class="modal fade" id="changeStatus-{{ $order->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="/kitchen/update/{{ $order->id }}" method="POST">
                                @csrf
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">Pesanan {{ $order->kode_pesanan }}</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <p><strong>Daftar Menu:</strong></p>
                                        <ul class="mb-3">
                                            @foreach($order->details as $detail)
                                                <li>{{ $detail->qty }}x {{ $detail->menu->nama_menu }}</li>
                                            @endforeach
                                        </ul>

                                        <label for="status-{{ $order->id }}">Ubah Status</label>
                                        <select name="status" id="status-{{ $order->id }}" class="form-select">
                                            <option value="Waiting" {{ $order->status == 'Waiting' ? 'selected' : '' }}>Waiting</option>
                                            <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Simpan Status</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <p class="text-muted">Belum ada pesanan.</p>
                    </div>
                </div>
            @endforelse
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
