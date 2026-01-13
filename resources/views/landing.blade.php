<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaundryKita - Laundry Terpercaya & Cepat</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .hero {
            background: linear-gradient(rgba(13, 110, 253, 0.85), rgba(13, 94, 215, 0.85)), url('https://images.unsplash.com/photo-1581578731545-4d4d4c7d8f4f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 150px 0;
            text-align: center;
        }
        .card-paket {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }
        .card-paket:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
        }
        .card-header-paket {
            background: #0d6efd;
            color: white;
            font-weight: bold;
        }
        .btn-cta {
            padding: 0.8rem 2.5rem;
            font-size: 1.2rem;
        }
        footer { background: #0d6efd; color: white; padding: 3rem 0; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">LaundryKita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary text-white px-4" href="{{ route('register') }}">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Selamat Datang di LaundryKita</h1>
            <p class="lead mb-4 fs-4">Cuci bersih, wangi seharian, rapi tanpa ribet – Antar jemput gratis!</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg btn-cta shadow">
                <i class="fas fa-arrow-right me-2"></i>Mulai Pesan Sekarang
            </a>
        </div>
    </section>

    <!-- Paket Laundry -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Paket Laundry Kami</h2>
            <div class="row g-4">
                @forelse ($packages as $package)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-paket shadow h-100">
                            <div class="card-header-paket text-center py-3">
                                <h5 class="mb-0">{{ $package->name }}</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="text-primary fw-bold mb-3">Rp {{ number_format($package->price, 0, ',', '.') }} / kg</h3>
                                <p class="text-muted mb-4">{{ $package->description ?? 'Paket standar berkualitas' }}</p>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                    Pilih Paket Ini
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">Belum ada paket tersedia saat ini</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimoni (Sederhana tapi bagus untuk TA) -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Apa Kata Pelanggan Kami</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-quote-left fa-3x text-primary mb-3"></i>
                            <p class="fst-italic">"LaundryKita cepat, bersih, dan ramah di kantong. Antar jemput gratis bikin hidup lebih mudah!"</p>
                            <h6 class="mt-3">- Budi, Palangkaraya</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-quote-left fa-3x text-primary mb-3"></i>
                            <p class="fst-italic">"Pakaian saya selalu wangi dan rapi. Pelayanan 5 bintang!"</p>
                            <h6 class="mt-3">- Siti, Palangkaraya</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-quote-left fa-3x text-primary mb-3"></i>
                            <p class="fst-italic">"Express 4 jam benar-benar cepat. Sangat puas!"</p>
                            <h6 class="mt-3">- Andi, Palangkaraya</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0">© {{ date('Y') }} LaundryKita - Cuci Bersih, Hidup Lebih Mudah</p>
        <small class="opacity-75">Palangkaraya, Kalimantan Tengah</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>