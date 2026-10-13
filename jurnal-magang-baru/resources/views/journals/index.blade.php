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
        .controls-box { background: #fff; border-radius: 10px; padding: 15px 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap; }
        .search-input { padding: 8px 12px; border: 2px solid #dee2e6; border-radius: 6px; width: 250px; font-size: 14px; font-family: inherit; }
        .search-input:focus { border-color: #0d6efd; outline: none; }
        .btn-group { display: flex; gap: 8px; align-items: center; }
        .btn { display: inline-flex; align-items: center; font-weight: 600; text-decoration: none; text-align: center; padding: 10px 18px; font-size: 14px; border-radius: 6px; cursor: pointer; transition: 0.2s; border: none; font-family: inherit; gap: 6px; }
        .btn-primary { background-color: #0d6efd; color: #fff; }
        .btn-primary:hover { background-color: #0b5ed7; }
        .btn-success { background-color: #198754; color: #fff; }
        .btn-success:hover { background-color: #157347; }
        .btn-pembimbing { background-color: #20c997; color: #fff; }
        .btn-pembimbing:hover { background-color: #1aa179; }
        .btn-outline-danger { background-color: transparent; color: #dc3545; border: 2px solid #dc3545; padding: 8px 16px; }
        .btn-outline-danger:hover { background-color: #dc3545; color: #fff; }
        .btn-warning { background-color: #ffc107; color: #212529; padding: 6px 12px; font-size: 13px; text-decoration: none; border-radius: 4px; }
        .btn-danger { background-color: #dc3545; color: #fff; padding: 6px 12px; font-size: 13px; border-radius: 4px; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: none; overflow: hidden; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { background-color: #cfe2ff; color: #084298; padding: 16px; text-transform: uppercase; font-size: 11px; font-weight: 700; border-bottom: 2px solid #dee2e6; }
        td { padding: 16px; border-bottom: 1px solid #dee2e6; color: #495057; font-size: 14px; }
        tr:hover { background-color: #f8f9fa; }
        .badge-danger { background: #f8d7da; color: #842029; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block; border: 1px solid #f5c2c7; }
        .badge-success { background: #d1e7dd; color: #0f5132; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block; border: 1px solid #badbcc; }
        .alert { padding: 15px 20px; background-color: #d1e7dd; color: #0f5132; border-radius: 8px; margin-bottom: 24px; font-weight: 600; border-left: 5px solid #0f5132; }
        .text-muted { color: #6c757d; }
        .text-center { text-align: center; }
        .d-flex { display: flex; }
        .gap-2 { gap: 8px; }
        .justify-content-center { justify-content: center; }

        @media print {
            body { background-color: #fff; padding: 0; margin: 0; visibility: hidden; }
            .container { max-width: 100%; width: 100%; padding: 0; }
            .header-box { border: none; box-shadow: none; padding: 10px 0; margin-bottom: 20px; }
            .user-welcome { display: block !important; font-size: 14px; }
            .user-welcome .user-name, .user-welcome .text-muted { font-size: 14px; }
            
            /* Sembunyikan elemen tertentu saat proses cetak berlangsung */
            #hideOnPrint, #btnProfilHide, .header-box .btn-group, .controls-box, .alert, .action-col { display: none !important; }
            
            .container, .header-box, .user-welcome, .user-name, .text-muted, .card, table, tr, th, td { visibility: visible; }
            .card { box-shadow: none; border: none; border-radius: 0; }
            th { background-color: #f0f0f0 !important; color: #000 !important; border-bottom: 2px solid #000; }
            td { border-bottom: 1px solid #ccc; }
}

    </style>
</head>
<body>
    <div class="container">
        
                <!-- HEADER PROFILE USER -->
        <div class="header-box">
            <div>
                <h2 class="text-primary"><i class="bi bi-journal-text"></i> E-Jurnal Magang</h2>
                <div class="user-welcome">
                    <span id="hideOnPrint">Selamat datang kembali, </span>
                    <span class="user-name">{{ Auth::user()->name }}</span> 
                    <span class="text-muted">({{ Auth::user()->email }})</span>
                    <!-- Tombol Lihat Profil Siswa yang Rapi -->
                    <a href="{{ route('profil.index') }}" id="btnProfilHide" style="color: #0d6efd; text-decoration: none; font-size: 12px; font-weight: bold; background: #e7f1ff; padding: 4px 10px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px; margin-left: 8px;">
                        <i class="bi bi-eye"></i> Lihat Profil
                    </a>
                </div>
            </div>
            <div class="btn-group-custom">
                <!-- Form Keluar Akun -->
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i> Keluar Akun
                    </button>
                </form>
            </div>
        </div>


        <!-- NOTIFIKASI SUKSES -->
        @if(session('success'))
            <div class="alert">
                ✨ {{ session('success') }}
            </div>
        @endif

        <!-- CONTROL BAR (SEARCH & BUTTONS) -->
        <div class="controls-box">
            <div>
                <input type="text" id="searchInput" class="search-input" onkeyup="searchTable()" placeholder="Cari kegiatan atau tanggal...">
            </div>
            <div class="btn-group">
                @if(Auth::user()->role === 'pembimbing')
                    <a href="{{ route('pembimbing.index') }}" class="btn btn-pembimbing">👨‍🏫 Panel Penilaian</a>
                @endif
                <button onclick="window.print()" class="btn btn-success">🖨️ Cetak Jurnal</button>
                <a href="{{ route('journals.create') }}" class="btn btn-primary">➕ Tambah Jurnal Baru</a>
            </div>
        </div>

        <!-- TABEL UTAMA DATA JURNAL -->
        <div class="card">
            <div class="table-responsive">
                <table id="journalTable">
                    <thead>
                        <tr>
                            <th style="width: 7%; text-align: center;">No</th>
                            <th style="width: 18%;">Tanggal Kerja</th>
                            <th style="width: 45%;">Kegiatan / Aktivitas Harian</th>
                            <th style="width: 18%;">Kendala</th>
                            <th style="width: 12%; text-align: center;" class="action-col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($journals as $key => $jurnal)
                            <tr>
                                <td class="text-center" style="font-weight: bold; color: #6c757d;">{{ $key + 1 }}</td>
                                <td style="font-weight: 600; color: #212529;">{{ \Carbon\Carbon::parse($jurnal->tanggal_kerja ?? $jurnal->tanggal)->translatedFormat('d M Y') }}</td>
                                <td style="white-space: pre-line; line-height: 1.5;">{{ $jurnal->kegiatan }}</td>
                                <td>
                                    @if($jurnal->kendala)
                                        <span class="badge-danger">⚠️ {{ $jurnal->kendala }}</span>
                                    @else
                                        <span class="badge-success">✅ Lancar</span>
                                    @endif
                                </td>
                                <td class="text-center action-col">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('journals.edit', $jurnal->id) }}" class="btn btn-warning" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                                        <form action="{{ route('journals.destroy', $jurnal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jurnal tanggal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted" style="padding: 60px 0;">
                                    <span style="font-size: 40px;">📂</span>
                                    <h3 style="margin: 10px 0 5px 0; color: #495057;">Belum Ada Catatan Jurnal</h3>
                                    <small>Silakan klik tombol <b>Tambah Jurnal Baru</b> untuk mencatat aktivitas magang Anda hari ini.</small>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Fungsi Live Search
        function searchTable() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("journalTable");
            var tr = table.getElementsByTagName("tr");

            for (var i = 1; i < tr.length; i++) {
                var tdArray = tr[i].getElementsByTagName("td");
                if (tdArray.length === 0) continue;
                
                var found = false;
                for (var j = 0; j < tdArray.length; j++) {
                    if (tdArray[j]) {
                        var txtValue = tdArray[j].textContent || tdArray[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = found ? "" : "none";
            }
        }
    </script>
</body>
</html>