<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jurnal Magang</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; padding: 40px 0; margin: 0; }
        .container { max-width: 1140px; margin: 0 auto; padding: 0 20px; }
        .header-box { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; border-left: 5px solid #0d6efd; }
        .text-primary { color: #0d6efd; margin: 0 0 5px 0; font-weight: 700; font-size: 26px; }
        .user-welcome { font-size: 14px; color: #6c757d; font-weight: 500; }
        .user-name { color: #0d6efd; font-weight: 700; }
        .stats-container { display: flex; gap: 15px; margin-bottom: 24px; flex-wrap: wrap; }
        .stat-card { background: #fff; padding: 15px 20px; border-radius: 10px; flex: 1; min-width: 200px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); display: flex; align-items: center; justify-content: space-between; }
        .stat-title { font-size: 13px; color: #6c757d; text-transform: uppercase; font-weight: 600; margin: 0; }
        .stat-value { font-size: 24px; font-weight: 700; color: #333; margin: 5px 0 0 0; }
        .stat-icon { font-size: 28px; background: #e7f1ff; padding: 10px; border-radius: 8px; color: #0d6efd; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; }
        .stat-icon.danger { background: #f8d7da; color: #dc3545; }
        .controls-box { background: #fff; border-radius: 10px; padding: 15px 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap; }
        .search-input { padding: 8px 12px; border: 2px solid #dee2e6; border-radius: 6px; width: 250px; font-size: 14px; font-family: inherit; }
        .search-input:focus { border-color: #0d6efd; outline: none; }
        .btn-group { display: flex; gap: 8px; align-items: center; }
        .btn { display: inline-flex; align-items: center; font-weight: 600; text-decoration: none; text-align: center; padding: 10px 18px; font-size: 14px; border-radius: 6px; cursor: pointer; transition: 0.2s; border: none; font-family: inherit; gap: 6px; }
        .btn-primary { background-color: #0d6efd; color: #fff; }
        .btn-primary:hover { background-color: #0b5ed7; }
        .btn-success { background-color: #198754; color: #fff; }
        .btn-success:hover { background-color: #157347; }
        .btn-outline-danger { background-color: transparent; color: #dc3545; border: 2px solid #dc3545; padding: 8px 16px; }
        .btn-outline-danger:hover { background-color: #dc3545; color: #fff; }
        .btn-warning { background-color: #ffc107; color: #212529; padding: 6px 12px; font-size: 13px; }
        .btn-warning:hover { background-color: #ffca2c; }
        .btn-danger { background-color: #dc3545; color: #fff; padding: 6px 12px; font-size: 13px; }
        .btn-danger:hover { background-color: #bb2d3b; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: none; overflow: hidden; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { background-color: #f8f9fa; color: #495057; padding: 16px; text-transform: uppercase; font-size: 11px; font-weight: 700; border-bottom: 2px solid #dee2e6; }
        td { padding: 16px; border-bottom: 1px solid #dee2e6; color: #495057; font-size: 14px; }
        tr:hover { background-color: #f8f9fa; }
        .badge-danger { background: #f8d7da; color: #842029; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block; border: 1px solid #f5c2c7; }
        .badge-success { background: #d1e7dd; color: #0f5132; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block; border: 1px solid #badbcc; }
        .alert { padding: 15px 20px; background-color: #d1e7dd; color: #0f5132; border-radius: 8px; margin-bottom: 24px; font-weight: 600; border-left: 5px solid #0f5132; box-shadow: 0 4px 6px rgba(0,0,0,0.01); }
        .text-muted { color: #6c757d; }
        .text-center { text-align: center; }
        .d-flex { display: flex; }
        .gap-2 { gap: 8px; }
        .justify-content-center { justify-content: center; }
    </style>
</head>
<body>
    <div class="container">
        
        <!-- HEADER & PROFIL USER -->
        <div class="header-box">
            <div>
                <h2 class="text-primary">📋 E-Jurnal Magang</h2>
                <div class="user-welcome">
                    Selamat datang, <span class="user-name">{{ Auth::user()->name }}</span> <span class="text-muted">({{ Auth::user()->email }})</span>
                </div>
            </div>
            <div class="btn-group">
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Keluar Akun 🚪</button>
                </form>
            </div>
        </div>

        <!-- NOTIFIKASI ACTION -->
        @if(session('success'))
            <div class="alert">
                ✨ {{ session('success') }}
            </div>
        @endif

        <!-- STATS DASHBOARD -->
        <div class="stats-container">
            <div class="stat-card">
                <div>
                    <p class="stat-title">Total Hari Kerja</p>
                    <h3 class="stat-value">{{ count($journals) }} Hari</h3>
                </div>
                <div class="stat-icon">📅</div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="stat-title">Kendala Dihadapi</p>
                    <h3 class="stat-value">
                        @php $counter = 0; @endphp
                        @foreach($journals as $j)
                            @if($j->kendala) @php $counter++; @endphp @endif
                        @endforeach
                        {{ $counter }} Masalah
                    </h3>
                </div>
                <div class="stat-icon danger">⚠️</div>
            </div>
        </div>

        <!-- CONTROL BAR -->
        <div class="controls-box">
            <div>
                <input type="text" id="searchInput" class="search-input" onkeyup="searchTable()" placeholder="Cari kegiatan atau tanggal...">
            </div>
            <div class="btn-group">
                <button onclick="window.print()" class="btn btn-success">🖨️ Cetak Jurnal</button>
                <a href="{{ route('journals.create') }}" class="btn btn-primary">➕ Tambah Jurnal Baru</a>
            </div>
        </div>

        <!-- TABEL UTAMA -->
        <div class="card">
            <div class="table-responsive">
                <table id="journalTable">
                    <thead>
                        <tr>
                            <th style="width: 7%; text-align: center;">No</th>
                            <th style="width: 18%;">Tanggal Kerja</th>
                            <th style="width: 45%;">Kegiatan / Aktivitas Harian</th>
                            <th style="width: 18%;">Kendala</th>
                            <th style="width: 12%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($journals) > 0)
                            @foreach($journals as $index => $journal)
                                <tr>
                                    <td class="text-center" style="font-weight: bold; color: #6c757d;">{{ $index + 1 }}</td>
                                    <td style="font-weight: 600; color: #212529;">{{ date('d M Y', strtotime($journal->tanggal)) }}</td>
                                    <td style="white-space: pre-line; line-height: 1.5;">{{ $journal->kegiatan }}</td>
                                    <td>
                                        @if($journal->kendala)
                                            <span class="badge-danger">⚠️ {{ $journal->kendala }}</span>
                                        @else
                                            <span class="badge-success">✅ Lancar</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('journals.edit', $journal->id) }}" class="btn btn-warning" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                                            <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jurnal tanggal ini?')" style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-muted" style="padding: 60px 0;">
                                    <span style="font-size: 40px;">📂</span>
