<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jurnal Magang</title>
    <!-- Gaya CSS Internal Mandiri (Anti-Gagal, Ringan, & Pasti Rapi) -->
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; padding: 50px 0; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 0 20px; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: none; overflow: hidden; }
        .card-header { background-color: #0d6efd; color: #fff; padding: 20px; }
        .card-header h4 { margin: 0; font-weight: 700; }
        .card-body { padding: 25px; }
        .mb-3 { margin-bottom: 20px; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #495057; }
        .form-control { width: 100%; padding: 10px 12px; font-size: 14px; border-radius: 6px; border: 2px solid #dee2e6; box-sizing: border-box; transition: 0.2s; font-family: inherit; }
        .form-control:focus { border-color: #0d6efd; outline: none; }
        textarea.form-control { resize: vertical; }
        .d-flex { display: flex; }
        .justify-content-between { justify-content: space-between; }
        .btn { display: inline-block; font-weight: 600; text-decoration: none; text-align: center; padding: 10px 20px; font-size: 14px; border-radius: 6px; cursor: pointer; transition: 0.2s; border: none; font-family: inherit; }
        .btn-light { background-color: #f8f9fa; color: #212529; border: 2px solid #dee2e6; }
        .btn-light:hover { background-color: #e2e6ea; }
        .btn-primary { background-color: #0d6efd; color: #fff; }
        .btn-primary:hover { background-color: #0b5ed7; }
        .pt-2 { padding-top: 15px; }
        .border-top { border-top: 1px solid #dee2e6; }
        .text-muted { color: #6c757d; font-weight: normal; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <!-- Header Utama Form -->
            <div class="card-header">
                <h4>📝 Isi Jurnal Harian Magang</h4>
            </div>
            
            <!-- Body Utama Form -->
            <div class="card-body">
                <!-- Memastikan Action Mengarah ke Rute Simpan yang Benar Melalui Form Murni -->
                <form action="/journals" method="POST">
                    <!-- Token CSRF Menggunakan Input Hidden Standar Agar Lolos Validasi Keamanan -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kegiatan / Aktivitas</label>
                        <textarea class="form-control" id="kegiatan" name="kegiatan" rows="5" placeholder="Tuliskan detail pekerjaan atau tugas yang Anda selesaikan hari ini..." required></textarea>
                    </div>

                    <div class="mb-3" style="margin-bottom: 30px;">
                        <label for="kendala" class="form-label">Kendala / Hambatan <span class="text-muted">(Opsional)</span></label>
                        <textarea class="form-control" id="kendala" name="kendala" rows="3" placeholder="Tuliskan kendala teknis atau non-teknis jika ada..."></textarea>
                    </div>

                    <!-- Tombol Navigasi Bawah -->
                    <div class="d-flex justify-content-between pt-2 border-top">
                        <a href="/" class="btn btn-light">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
