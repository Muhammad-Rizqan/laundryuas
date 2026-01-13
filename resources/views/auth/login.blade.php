<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LaundryKita</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            background: white; /* Bagian yang kamu minta jadi putih */
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            max-width: 450px;
            margin: auto;
        }
        .card-header {
            background: linear-gradient(90deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
            padding: 2.5rem 1.5rem;
            text-align: center;
        }
        .form-control-lg {
            border-radius: 10px;
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
        }
        .btn-login {
            padding: 0.8rem;
            font-size: 1.15rem;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }
        .text-link {
            color: #0d6efd;
            text-decoration: none;
        }
        .text-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="login-card">
                <div class="card-header">
                    <h3 class="mb-1">Login ke LaundryKita</h3>
                    <p class="mb-0 opacity-75">Masuk untuk akses layanan terbaik</p>
                </div>

                <div class="card-body p-5">
                    <!-- Notifikasi Error -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Ada kesalahan!</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" placeholder="contoh@email.com" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   placeholder="Masukkan password Anda" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Login -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i> Masuk
                            </button>
                        </div>

                        <!-- Link Tambahan -->
                        <div class="text-center">
                            <p class="mb-0">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-link fw-bold">Daftar sekarang</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>