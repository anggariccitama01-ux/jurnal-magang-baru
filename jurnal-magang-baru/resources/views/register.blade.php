<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun E-Jurnal Magang</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .register-container { width: 100%; max-width: 400px; padding: 20px; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.05); border: none; padding: 30px; }
        .text-center { text-align: center; }
        .text-primary { color: #0d6efd; margin: 0 0 10px 0; font-weight: 700; font-size: 28px; }
        .text-muted { color: #6c757d; font-size: 14px; margin-bottom: 25px; }
        .mb-3 { margin-bottom: 15px; }
        .form-label { display: block; margin-bottom: 6px; font-weight: 600; color: #495057; font-size: 14px; }
        .form-control { width: 100%; padding: 10px 12px; font-size: 14px; border-radius: 8px; border: 2px solid #dee2e6; box-sizing: border-box; transition: 0.2s; font-family: inherit; }
        .form-control:focus { border-color: #0d6efd; outline: none; }
        .btn { display: block; width: 100%; font-weight: 600; text-align: center; padding: 12px; font-size: 15px; border-radius: 8px; cursor: pointer; transition: 0.2s; border: none; font-family: inherit; margin-top: 15px; }
        .btn-primary { background-color: #0d6efd; color: #fff; }
        .btn-primary:hover { background-color: #0b5ed7; }
        .alert-danger { padding: 10px 12px; background-color: #f8d7da; color: #842029; border-radius: 8px; margin-bottom: 15px; font-weight: 500; font-size: 13px; border: 1px solid #f5c2c7; }
        .login-link { text-align: center; margin-top: 20px; font-size: 13px; color: #6c757d; }
        .login-link a { color: #0d6efd; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

    <div class="register-container">
        <div class="card">
            <div class="text-center">
                <h3 class="text-primary">📝 Daftar Akun</h3>
                <p class="text-muted">Buat akun baru untuk mengisi jurnal magang</p>
            </div>
            
            @if($errors->any())
                <div class="alert-danger">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Nama Anda" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="nama@gmail.com" value="{{ old('email') }}">
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password <span style="font-weight:normal; font-size:11px;">(Min. 6 Karakter)</span></label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="••••••">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="••••••">
                </div>
                
                <button type="submit" class="btn btn-primary">Daftar Akun</button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>
    </div>

</body>
</html>
