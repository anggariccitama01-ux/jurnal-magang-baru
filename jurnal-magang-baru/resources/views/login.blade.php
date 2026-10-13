<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Jurnal Magang</title>
    <!-- Gaya CSS Internal Mandiri (Anti-Gagal, Ringan, & Pasti Rapi) -->
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f6f9; 
            color: #333; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
            margin: 0; 
        }
        .login-container { 
            width: 100%; 
            max-width: 400px; 
            padding: 20px; 
        }
        .card { 
            background: #fff; 
            border-radius: 12px; 
            box-shadow: 0 8px 24px rgba(0,0,0,0.05); 
            border: none; 
            overflow: hidden; 
            padding: 30px;
        }
        .text-center { 
            text-align: center; 
        }
        .text-primary { 
            color: #0d6efd; 
            margin: 0 0 10px 0; 
            font-weight: 700; 
            font-size: 28px; 
        }
        .text-muted { 
            color: #6c757d; 
            font-size: 14px; 
            margin-bottom: 30px; 
        }
        .mb-3 { 
            margin-bottom: 20px; 
        }
        .form-label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #495057; 
            font-size: 14px;
        }
        .form-control { 
            width: 100%; 
            padding: 12px 14px; 
            font-size: 14px; 
            border-radius: 8px; 
            border: 2px solid #dee2e6; 
            box-sizing: border-box; 
            transition: 0.2s; 
            font-family: inherit; 
        }
        .form-control:focus { 
            border-color: #0d6efd; 
            outline: none; 
        }
        .btn { 
            display: block; 
            width: 100%; 
            font-weight: 600; 
            text-align: center; 
            padding: 12px; 
            font-size: 15px; 
            border-radius: 8px; 
            cursor: pointer; 
            transition: 0.2s; 
            border: none; 
            font-family: inherit; 
            margin-top: 10px;
        }
        .btn-primary { 
            background-color: #0d6efd; 
            color: #fff; 
        }
        .btn-primary:hover { 
            background-color: #0b5ed7; 
        }
        .alert-success { 
            padding: 12px 15px; 
            background-color: #d1e7dd; 
            color: #0f5132; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            font-weight: 500; 
            font-size: 13px;
            border: 1px solid #badbcc;
        }
        .alert-danger { 
            padding: 12px 15px; 
            background-color: #f8d7da; 
            color: #842029; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            font-weight: 500; 
            font-size: 13px;
            border: 1px solid #f5c2c7;
        }
        .register-link {
            text-align: center; 
            margin-top: 20px; 
            font-size: 13px; 
            color: #6c757d;
        }
        .register-link a {
            color: #0d6efd; 
            text-decoration: none; 
            font-weight: 600;
        }
        .info-box {
            background-color: #e7f1ff;
            border-radius: 8px;
            padding: 12px;
            margin-top: 25px;
            font-size: 12px;
            color: #084298;
            border: 1px solid #b6d4fe;
            line-height: 1.5;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="card">
            <div class="text-center">
                <h3 class="text-primary">🔐 E-Jurnal</h3>
                <p class="text-muted">Silakan masuk untuk mengelola jurnal magang</p>
            </div>
            
            <!-- Menampilkan Pesan Sukses Setelah Daftar Akun -->
            @if(session('success'))
                <div class="alert-success">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <!-- Menampilkan Pesan Kesalahan jika Email/PW Salah -->
            @if($errors->any())
                <div class="alert-danger">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="nama@gmail.com" autofocus>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="••••••">
                </div>
                
                <button type="submit" class="btn btn-primary">Masuk Aplikasi</button>
            </form>

            <!-- Tautan Navigasi ke Halaman Register -->
            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
</body>
</html>
