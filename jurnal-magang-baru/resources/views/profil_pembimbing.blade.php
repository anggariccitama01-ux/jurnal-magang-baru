<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pembimbing Lapangan</title>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f6f9; padding: 20px; }
        .card { background: white; max-width: 600px; margin: 0 auto; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background: #28a745; color: white; padding: 30px; text-align: center; }
        .avatar { width: 90px; height: 90px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: bold; margin: 0 auto 10px; object-fit: cover; border: 3px solid #fff; color: #28a745; }
        .content { padding: 20px; }
        .row-info { display: flex; padding: 10px 0; border-bottom: 1px solid #eee; align-items: center; }
        .label { width: 150px; font-weight: bold; color: #555; }
        .value { flex-grow: 1; color: #333; }
        .badge { background: #e2e8f0; padding: 3px 8px; border-radius: 4px; font-size: 14px; color: #4a5568; text-transform: capitalize; }
        .section-title { margin-top: 25px; font-weight: bold; color: #333; border-bottom: 2px solid #28a745; padding-bottom: 5px; }
        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-warning { background-color: #ffc107; color: #212529; }
        .btn-success { background-color: #28a745; color: white; width: 100%; margin-top: 10px; }
        .footer-action { display: flex; justify-content: space-between; margin-top: 25px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: #555; font-size: 14px; }
        .form-control { width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; }
        .alert-success { padding: 12px 15px; background-color: #d4edda; color: #155724; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb; font-size: 14px; }
        @media print { .footer-action, .btn, button, .edit-section { display: none !important; } }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        @if($user->foto)
            <img src="{{ asset('storage/' . $user->foto) }}" class="avatar" alt="Foto Profil">
        @else
            <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        @endif
        <h2>{{ $user->name }}</h2>
        <p>Gelar / Pembimbing Lapangan Aktif</p>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert-success">✨ {{ session('success') }}</div>
        @endif

        <h4 class="section-title">📌 BIODATA PEMBIMBING</h4>
        
        <div class="row-info">
            <div class="label">Nama Lengkap</div>
            <div class="value">: {{ $user->name }}</div>
        </div>
        <div class="row-info">
            <div class="label">Alamat Email</div>
            <div class="value">: {{ $user->email }}</div>
        </div>
        <div class="row-info">
            <div class="label">Status Akses</div>
            <div class="value">: <span class="badge" style="background-color: #d4edda; color: #155724;">{{ $user->role }}</span></div>
        </div>
        <div class="row-info">
            <div class="label">Terdaftar Sejak</div>
            <div class="value">: {{ $user->created_at ? $user->created_at->format('d F Y') : '-' }}</div>
        </div>

        <!-- FORM EDIT PROFIL & UPLOAD FOTO -->
        <div class="edit-section">
            <h4 class="section-title">⚙️ EDIT FOTO & DATA PROFIL</h4>
            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" style="margin-top: 15px;">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label>Unggah Foto Profil Baru</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small style="color: #6c757d;">Format: JPG, JPEG, PNG (Maksimal 2MB)</small>
                </div>
                <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
            </form>
        </div>

        <div class="footer-action">
            <a href="{{ route('pembimbing.index') }}" class="btn btn-secondary">◀ Halaman Utama</a>
            <button class="btn btn-warning" onclick="window.print()">🖨️ Cetak Profil</button>
        </div>
    </div>
</div>

</body>
</html>
