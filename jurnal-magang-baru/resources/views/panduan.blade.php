<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi Fitur & Isi Website</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        body {
            background-color: #f4f6f9;
            color: #333;
            padding: 40px 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .welcome-box {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 40px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
        }
        .welcome-box h1 {
            margin-bottom: 10px;
            font-size: 28px;
        }
        .welcome-box p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.5;
        }
        .main-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
            text-transform: uppercase;
            border-left: 4px solid #007bff;
            padding-left: 10px;
        }
        .grid-fitur {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card-fitur {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-top: 4px solid #ced4da;
            transition: transform 0.2s;
        }
        .card-fitur:hover {
            transform: translateY(-3px);
        }
        .fitur-siswa { border-top-color: #007bff; }
        .fitur-pembimbing { border-top-color: #28a745; }
        .fitur-umum { border-top-color: #ffc107; }
        
        .card-fitur h3 {
            font-size: 18px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .card-fitur ul {
            list-style: none;
            padding: 0;
        }
        .card-fitur li {
            font-size: 14px;
            color: #555;
            padding: 6px 0;
            border-bottom: 1px dashed #eee;
            display: flex;
            align-items: flex-start;
        }
        .card-fitur li::before {
            content: "✓";
            color: inherit;
            font-weight: bold;
            margin-right: 8px;
        }
        .role-badge {
            display: inline-block;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .badge-siswa { background-color: #e8f4fd; color: #007bff; }
        .badge-pembimbing { background-color: #eaf7ed; color: #28a745; }
        .badge-umum { background-color: #fff9db; color: #977500; }

        .footer-action {
            text-align: center;
            margin-top: 40px;
        }
        .btn {
            padding: 12px 30px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0,123,255,0.2);
            transition: background 0.2s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Kotak Selamat Datang Utama -->
    <div class="welcome-box">
        <h1>Peta Fitur & Struktur Website</h1>
        <p>Selamat datang di Aplikasi Logbook Magang Digital. Halaman ini merangkum seluruh sistem, modul, dan hak akses data yang berjalan di dalam website kami.</p>
    </div>

    <h2 class="main-title">Daftar Modul & Isi Sistem</h2>

    <div class="grid-fitur">
        <!-- Blok Fitur Siswa -->
        <div class="card-fitur fitur-siswa">
            <span class="role-badge badge-siswa">Akses Siswa</span>
            <h3>📝 Modul Jurnal Harian</h3>
            <ul>
                <li><strong>Isi Aktivitas:</strong> Form input tanggal, judul kegiatan, dan deskripsi pekerjaan magang harian.</li>
                <li><strong>Riwayat Logbook:</strong> Daftar tabel seluruh kegiatan yang pernah ditulis secara berurutan.</li>
                <li><strong>Status Validasi:</strong> Melihat tanda persetujuan atau catatan koreksi dari pembimbing.</li>
            </ul>
        </div>

        <!-- Blok Fitur Pembimbing -->
        <div class="card-fitur fitur-pembimbing">
            <span class="role-badge badge-pembimbing">Akses Pembimbing</span>
            <h3>🔍 Modul Kendali & Monitoring</h3>
            <ul>
                <li><strong>Daftar Jurnal Siswa:</strong> Melihat rangkuman aktivitas harian dari seluruh siswa bimbingan.</li>
                <li><strong>Kolom Komentar:</strong> Memberikan penilaian, arahan, atau feedback langsung pada baris jurnal.</li>
                <li><strong>Validasi Parap:</strong> Mengubah status verifikasi jurnal menjadi disetujui secara digital.</li>
            </ul>
        </div>

        <!-- Blok Fitur Umum / Profil -->
        <div class="card-fitur fitur-umum">
            <span class="role-badge badge-umum">Semua Pengguna</span>
            <h3>🪪 Modul Biodata & Profil</h3>
            <ul>
                <li><strong>Integrasi Akun:</strong> Tampilan detail nama lengkap, email instansi, dan penentuan tingkatan role.</li>
                <li><strong>Hubungkan Pembimbing:</strong> Dropdown otomatis bagi siswa untuk memilih dosen/guru lapangan.</li>
                <li><strong>Cetak Cetak Fisik:</strong> Fitur ekspor lembar cetak profil bersih bebas tombol untuk kebutuhan berkas.</li>
            </ul>
        </div>
    </div>

    <!-- Tombol Navigasi Menuju Login / Dashboard -->
    <div class="footer-action">
        <a href="{{ route('login') }}" class="btn">Masuk ke Sistem Aplikasi ▶</a>
    </div>
</div>

</body>
</html>
