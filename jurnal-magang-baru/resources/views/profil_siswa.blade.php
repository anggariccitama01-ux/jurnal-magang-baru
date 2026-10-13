<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Biodata Siswa</title>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f6f9; padding: 40px 20px; margin: 0; }
        .card { background: white; max-width: 650px; margin: 0 auto; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow: hidden; }
        .header { background: #007bff; color: white; padding: 40px 20px; text-align: center; }
        .avatar { width: 90px; height: 90px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 38px; font-weight: bold; margin: 0 auto 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); object-fit: cover; border: 3px solid #fff; color: #007bff; }
        .header h2 { margin: 0 0 5px 0; font-size: 24px; }
        .header p { margin: 0; opacity: 0.9; font-size: 15px; }
        .content { padding: 30px; }
        .section-title { margin-top: 30px; font-weight: bold; color: #333; border-bottom: 2px solid #007bff; padding-bottom: 8px; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px; }
        .row-info { display: flex; padding: 14px 0; border-bottom: 1px solid #f1f1f1; align-items: center; }
        .label { width: 180px; font-weight: bold; color: #555; }
        .value { flex-grow: 1; color: #333; }
        .badge { background: #e2f0d9; padding: 4px 12px; border-radius: 20px; font-size: 13px; color: #388e3c; font-weight: bold; text-transform: capitalize; }
        .alert-success { padding: 12px 15px; background-color: #d4edda; color: #155724; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb; font-size: 14px; }
        .footer-action { display: flex; justify-content: space-between; margin-top: 35px; padding-top: 20px; border-top: 1px solid #eee; }
        .btn { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; font-size: 14px; transition: all 0.2s; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-secondary { background-color: #f8f9fa; color: #495057; border: 1px solid #ced4da; }
        .btn-secondary:hover { background-color: #e2e6ea; }
        .btn-warning { background-color: #ffc107; color: #212529; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-success { background-color: #28a745; color: white; width: 100%; margin-top: 10px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: #555; font-size: 14px; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box; }
        @media print { .footer-action, .btn, button, .edit-section, .connect-section { display: none !important; } body, .card, .header, .avatar, .badge { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; } body { background-color: #f4f6f9; padding: 0; } .card { box-shadow: none; border: none; max-width: 100%; } }
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
        <p>Mahasiswa / Siswa Magang Aktif</p>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <h4 class="section-title">📌 BIODATA DIRI</h4>
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
            <div class="value">: <span class="badge">{{ $user->role }}</span></div>
        </div>
        <div class="row-info">
            <div class="label">Terdaftar Sejak</div>
            <div class="value">: {{ $user->created_at ? $user->created_at->format('d F Y') : '-' }}</div>
        </div>

        <h4 class="section-title">🪪 PEMBIMBING LAPANGAN</h4>
        
        @if($pembimbing)
            <div class="row-info" style="border-bottom: none; padding-bottom: 0;">
                <div class="label">Nama Pembimbing</div>
                <div class="value" style="color: #28a745; font-weight: bold;">: {{ $pembimbing->nama }}</div>
            </div>
            @if($pembimbing->nip)
                <div class="row-info" style="border-bottom: none; padding-top: 5px;">
                    <div class="label">NIP</div>
                    <div class="value">: {{ $pembimbing->nip }}</div>
                </div>
            @endif
        @else
            <div class="connect-section" style="color: #856404; background-color: #fff3cd; padding: 15px; border-radius: 8px; border: 1px solid #ffeeba; margin-top: 15px;">
                <p style="margin: 0 0 12px 0; font-weight: bold;">⚠️ Akun Anda belum terhubung dengan Pembimbing Lapangan.</p>
                <form action="{{ route('profil.updatePembimbing') }}" method="POST">
                    @csrf
                    <div style="display: flex; gap: 10px;">
                        <select name="pembimbing_id" id="pembimbing_id" required style="padding: 10px; border-radius: 6px; border: 1px solid #ced4da; flex-grow: 1; background: white; font-size: 14px;">
                            <option value="">-- Pilih Pembimbing --</option>
                            @if(isset($daftar_pembimbing) && $daftar_pembimbing->count() > 0)
                                @foreach($daftar_pembimbing as $pemb)
                                    <option value="{{ $pemb->id }}">{{ $pemb->nama }}</option>
                                @endforeach
                            @endif
                        </select>
                        <button type="submit" class="btn btn-primary">Hubungkan</button>
                    </div>
                </form>
            </div>
        @endif

        <!-- FORM EDIT PROFIL & UPLOAD FOTO SISWA -->
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
            <a href="{{ route('journals.index') }}" class="btn btn-secondary">◀ Halaman Utama</a>
            <button class="btn btn-warning" onclick="window.print()">🖨️ Cetak Profil</button>
        </div>
    </div>
</div>

</body>
</html>
