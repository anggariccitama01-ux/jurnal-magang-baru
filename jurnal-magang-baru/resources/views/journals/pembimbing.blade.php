<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembimbing - Jurnal Magang</title>
    <!-- Tambahkan Bootstrap Icons untuk ikon tombol -->
    <link rel="stylesheet" href="https://jsdelivr.net">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; padding: 40px 0; margin: 0; }
        .container { max-width: 1300px; margin: 0 auto; padding: 0 20px; }
        .header-box { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 24px; border-left: 5px solid #20c997; }
        .text-success { color: #20c997; margin: 0; font-weight: 700; font-size: 26px; display: flex; align-items: center; gap: 8px; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: none; overflow: hidden; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; table-layout: fixed; }
        th { background-color: #e8faf4; color: #0f5132; padding: 16px; text-transform: uppercase; font-size: 11px; font-weight: 700; border-bottom: 2px solid #dee2e6; letter-spacing: 0.5px; }
        td { padding: 16px; border-bottom: 1px solid #dee2e6; color: #495057; font-size: 14px; vertical-align: middle; word-wrap: break-word; }
        tr:hover { background-color: #f8f9fa; }
        
        /* Form & Input */
        .input-group-custom { display: flex; width: 100%; max-width: 300px; border: 2px solid #dee2e6; border-radius: 6px; overflow: hidden; background: #fff; transition: border-color 0.2s; }
        .input-group-custom:focus-within { border-color: #20c997; }
        .form-control-custom { flex: 1; border: none; padding: 8px 12px; font-size: 13px; outline: none; font-family: inherit; }
        .btn-send { background: #20c997; color: white; border: none; padding: 0 15px; font-size: 12px; font-weight: 600; cursor: pointer; font-family: inherit; transition: background 0.2s; }
        .btn-send:hover { background: #198754; }

        /* Tombol Aksi */
        .btn-action { font-weight: 600; text-decoration: none; padding: 8px 16px; font-size: 13px; border-radius: 6px; cursor: pointer; border: none; font-family: inherit; display: inline-flex; align-items: center; gap: 6px; transition: opacity 0.2s; }
        .btn-action:hover { opacity: 0.9; }
        .btn-success-custom { background-color: #20c997; color: #fff; }
        .btn-danger-custom { background-color: #dc3545; color: #fff; }
        
        /* Badges */
        .badge-status { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }
        .badge-danger { background: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }
        .badge-success { background: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }
        
        .alert { padding: 15px 20px; background-color: #d1e7dd; color: #0f5132; border-radius: 8px; margin-bottom: 24px; font-weight: 600; border-left: 5px solid #0f5132; }
        .comment-box { background-color: #f8f9fa; padding: 8px 12px; border-radius: 6px; border-left: 3px solid #6c757d; font-size: 12px; margin-bottom: 6px; color: #495057; font-style: italic; max-width: 300px; }
        
        /* Tata Letak Kolom Evaluasi */
        .evaluasi-wrapper { display: flex; flex-direction: column; gap: 12px; }
        .flex-actions { display: flex; align-items: center; gap: 8px; flex-wrap: nowrap; }
        .d-inline-form { display: inline-block; margin: 0; }
    </style>
</head>
<body>
    <div class="container">
        
       <!-- HEADER BOX -->
<div class="header-box" style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 class="text-success">👨‍🏫 Panel Pembimbing Magang</h2>
        <small style="color: #6c757d; display: block; margin-top: 4px;">Silakan periksa aktivitas harian mahasiswa dan berikan penilaian/catatan.</small>
    </div>
    <div style="display: flex; gap: 10px; align-items: center;">
        <!-- Tombol Lihat Profil Pembimbing -->
        <a href="{{ route('profil.index') }}" class="btn-action" style="background-color: #0d6efd; color: white; padding: 10px 18px; font-size: 14px; text-decoration: none; border-radius: 6px; display: inline-flex; align-items: center; gap: 6px;">
            <i class="bi bi-person-circle"></i> Lihat Profil
        </a>

        <!-- Form Prosedur Keluar Akun (Logout) -->
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="btn-action btn-danger-custom" style="padding: 10px 18px; font-size: 14px;">
                <i class="bi bi-box-arrow-right"></i> Keluar Akun
            </button>
        </form>
    </div>
</div>


        @if(session('success'))
            <div class="alert">✨ {{ session('success') }}</div>
        @endif

        <!-- TABEL UTAMA PENILAIAN JURNAL -->
        <div class="card">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 6%; text-align: center;">No</th>
                            <th style="width: 14%;">Tanggal</th>
                            <th style="width: 30%;">Aktivitas / Kegiatan</th>
                            <th style="width: 15%;">Kendala Mahasiswa</th>
                            <th style="width: 35%;">Aksi & Penilaian Pembimbing</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($journals as $index => $journal)
                            <tr>
                                <td style="text-align: center; font-weight: bold; color: #6c757d;">{{ $index + 1 }}</td>
                                <td style="font-weight: 600;">{{ date('d M Y', strtotime($journal->tanggal)) }}</td>
                                <td style="white-space: pre-line; line-height: 1.5;">{{ $journal->kegiatan }}</td>
                                <td>
                                    @if($journal->kendala == 'bermasalah')
                                        <span class="badge-status badge-danger">⚠️ Bermasalah</span>
                                    @else
                                        <span class="badge-status badge-success">✅ Lancar</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="evaluasi-wrapper">
                                        <!-- BARIS TOMBOL VALIDASI -->
                                        <div class="flex-actions">
                                            <!-- Tombol Terima -->
                                            <form action="{{ route('journals.updateStatus', [$journal->id, 'lancar']) }}" method="POST" class="d-inline-form">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-action btn-success-custom">
                                                    <i class="bi bi-check-circle"></i> Terima
                                                </button>
                                            </form>

                                            <!-- Tombol Tolak -->
                                            <form action="{{ route('journals.updateStatus', [$journal->id, 'bermasalah']) }}" method="POST" class="d-inline-form">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-action btn-danger-custom">
                                                    <i class="bi bi-x-circle"></i> Tolak
                                                </button>
                                            </form>
                                        </div>

                                        <!-- BARIS CATATAN EVALUASI TEXT -->
                                        <div>
                                            @if($journal->catatan_pembimbing)
                                                <div class="comment-box">
                                                    <b>Catatan aktif:</b> "{{ $journal->catatan_pembimbing }}"
                                                </div>
                                            @endif
                                            
                                            <form action="{{ route('pembimbing.komentar', $journal->id) }}" method="POST" class="input-group-custom">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="catatan_pembimbing" class="form-control-custom" placeholder="Tulis evaluasi / nilai..." required value="{{ $journal->catatan_pembimbing }}">
                                                <button type="submit" class="btn-send">Kirim</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #6c757d; padding: 50px 0;">Belum ada data jurnal mahasiswa yang diinputkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
