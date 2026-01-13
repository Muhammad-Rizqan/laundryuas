<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LaundryKita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card overflow-hidden">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">Daftar Akun Baru</h3>
                    <p class="mb-0 mt-2">Mulai gunakan layanan LaundryKita sekarang</p>
                </div>

                <div class="card-body p-4 p-md-5">
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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap Anda">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required placeholder="contoh@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   required placeholder="Minimal 8 karakter">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="form-control form-control-lg" required placeholder="Ketik ulang password">
                        </div>

                        <!-- Nomor HP & Alamat (opsional) -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="phone" class="form-label fw-bold">Nomor HP</label>
                                <input type="tel" name="phone" id="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone') }}" placeholder="08123456789">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="address" class="form-label fw-bold">Alamat</label>
                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" 
                                          rows="2" placeholder="Alamat lengkap Anda">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p>Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-primary fw-bold">Login di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>