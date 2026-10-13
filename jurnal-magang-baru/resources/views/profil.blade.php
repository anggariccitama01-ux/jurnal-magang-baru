<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Biodata Siswa</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; padding: 50px 0; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 0 20px; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: none; overflow: hidden; }
        .card-header { background-color: #0d6efd; color: #fff; padding: 30px 20px; text-align: center; position: relative; }
        .avatar-circle { width: 90px; height: 90px; background-color: #fff; color: #0d6efd; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 700; margin: 0 auto 12px auto; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-header h3 { margin: 0; font-weight: 700; font-size: 22px; }
        .card-header p { margin: 5px 0 0 0; opacity: 0.9; font-size: 14px; }
        .card-body { padding: 30px; }
        .section-title { font-size: 13px; color: #6c757d; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin: 0 0 15px 0; padding-bottom: 5px; border-bottom: 2px solid #e9ecef; }
        .info-group { display: flex; margin-bottom: 15px; font-size: 14px; line-height: 1.5; }
        .info-label { width: 35%; font-weight: 600; color: #495057; }
        .info-value { width: 65%; color: #212529; }
        .badge-role { background-color: #e7f1ff; color: #0d6efd; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block; text-transform: capitalize; }
        .d-flex { display: flex; }
        .justify-content-between { justify-content: space-between; }
        .btn { display: inline-block; font-weight: 600; text-decoration: none; text-align: center; padding: 10px 20px; font-size: 14px; border-radius: 6px; cursor: pointer; transition: 0.2s; border: none; font-family: inherit; }
        .btn-light { background-color: #f8f9fa; color: #212529; border: 2px solid #dee2e6; }
        .btn-light:hover { background-color: #e2e6ea; }
        .btn-warning { background-color: #ffc107; color: #212529; }
        .btn-warning:hover { background-color: #ffca2c; }
        .pt-3 { padding-top: 20px; }
        .border-top { border-top: 1px solid #dee2e6; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <!-- Header Kartu Profil -->
            <div class="card-header">
                <div class="avatar-circle">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>
                <h3>{{ $user->name ?? 'Pengguna' }}</h3>
                <p>Mahasiswa / Siswa Magang Aktif</p>
            </div>
            
            <div class="card-body">
                <!-- Bagian 1: Informasi Akun -->
                <h5 class="section-title">📌 Biodata Diri</h5>
                <div class="info-group">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value">: {{ $user->name ?? '-' }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Alamat Email</div>
                    <div class="info-value">: {{ $user->email ?? '-' }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Status Akses</div>
                    <div class="info-value">: <span class="badge-role">{{ $user->role ?? 'Siswa' }}</span></div>
                </div>
                <div class="info-group" style="margin-bottom: 30px;">
                    <div class="info-label">Terdaftar Sejak</div>
                    <div class="info-value">: {{ isset($user->created_at) ? date('d F Y', strtotime($user->created_at)) : '-' }}</div>
                </div>

                <!-- Bagian 2: Informasi Hubungan Pembimbing -->
                <h5 class="section-title">👨‍🏫 Pembimbing Lapangan</h5>

                @php
                    $pembimbing = $user->pembimbing ?? null;
                @endphp

             @if($pembimbing)
    <!-- TAMPILAN JIKA SUDAH ADA PEMBIMBING -->
    <div style="padding: 10px 0; color: #333;">
        <strong>Nama Pembimbing:</strong> {{ $pembimbing->nama }}
    </div>
@else
    <!-- TAMPILAN JIKA BELUM ADA PEMBIMBING -->
    <div style="color: #666; margin-bottom: 15px;">
        Akun Anda belum terhubung dengan Pembimbing Lapangan...
    </div>

    <!-- FORM DROPDOWN OTOMATIS -->
    <form action="{{ route('profil.updatePembimbing') }}" method="POST" style="margin-top: 10px; max-width: 400px;">
        @csrf
        <div style="display: flex; gap: 10px;">
            <select name="pembimbing_id" id="pembimbing_id" required style="padding: 8px; border-radius: 4px; border: 1px solid #ccc; flex-grow: 1; background: white;">
                <option value="">-- Pilih Pembimbing Lapangan --</option>
                @if(isset($daftar_pembimbing) && $daftar_pembimbing->count() > 0)
                    @foreach($daftar_pembimbing as $pemb)
                        <option value="{{ $pemb->id }}">{{ $pemb->nama }}</option>
                    @endforeach
                @else
                    <option value="" disabled>Data pembimbing belum ada di database</option>
                @endif
            </select>
            <button type="submit" style="background-color: #007bff; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                Hubungkan
            </button>
        </div>
    </form>
@endif

                <!-- Tombol Kembali Navigasi -->
                <div class="d-flex justify-content-between pt-3 border-top">
                    <a href="{{ Route::has('journals.index') ? route('journals.index') : url('/') }}" class="btn btn-light">◀ Halaman Utama</a>
                    <button onclick="window.print()" class="btn btn-warning">🖨️ Cetak Profil</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>