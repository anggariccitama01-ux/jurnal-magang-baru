<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// ==========================================
// 1. TAMPILAN AWAL SEBELUM LOGIN (WELCOME / PANDUAN)
// ==========================================
Route::get('/', function () {
    if (Auth::check()) {
        // Jika sudah login, otomatis lempar ke halaman dashboard masing-masing
        if (Auth::user()->role === 'pembimbing') {
            return redirect('/pembimbing');
        }
        return redirect('/dashboard-siswa');
    }
    // Jika belum login, tampilkan halaman panduan isi web
    return view('panduan');
})->name('panduan.index');


// ==========================================
// 2. JALUR UTAMA WEBSITE (WAJIB LOGIN)
// ==========================================

// Jalur untuk Siswa
Route::get('/dashboard-siswa', [JournalController::class, 'index'])->name('journals.index')->middleware('auth');
Route::resource('journals', JournalController::class)->middleware('auth');

// Jalur untuk Pembimbing
Route::get('/pembimbing', [JournalController::class, 'pembimbingIndex'])->name('pembimbing.index')->middleware('auth');
Route::put('/pembimbing/{id}/komentar', [JournalController::class, 'pembimbingKomentar'])->name('pembimbing.komentar')->middleware('auth');

// Rute untuk memproses tombol Terima & Tolak dari Pembimbing
Route::patch('/journals/{id}/status/{status}', [App\Http\Controllers\JournalController::class, 'updateStatus'])->name('journals.updateStatus')->middleware('auth');

// Rute Manajemen Profil (Siswa & Pembimbing dialihkan otomatis di Controller)
Route::get('/profil', [ProfilController::class, 'show'])->name('profil.index')->middleware('auth');
Route::post('/profil/update-pembimbing', [ProfilController::class, 'updatePembimbing'])->name('profil.updatePembimbing')->middleware('auth');

// Rute Manajemen Profil (Siswa & Pembimbing)
Route::get('/profil', [ProfilController::class, 'show'])->name('profil.index')->middleware('auth');
Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update')->middleware('auth');
Route::post('/profil/update-pembimbing', [ProfilController::class, 'updatePembimbing'])->name('profil.updatePembimbing')->middleware('auth');


// ==========================================
// 3. NAVIGASI TAMPILAN FORM LOGIN & REGISTER
// ==========================================
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/profil');
    }
    return view('login');
})->name('login');

Route::get('/register', function () {
    if (Auth::check()) {
        return redirect('/profil');
    }
    return view('register');
})->name('register');


// ==========================================
// 4. PROSES DATA FORM REGISTER & LOGIN
// ==========================================

// Proses Pendaftaran Akun Siswa Baru
Route::post('/register', function (\Illuminate\Http\Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    DB::table('users')->insert([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'role' => 'siswa',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect('/login')->with('success', 'Akun berhasil didaftarkan! Silakan masuk.');
})->name('register.store');

// Proses Pengecekan saat Klik Tombol Masuk (Login)
Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // A. BYPASS CEK UNTUK AKUN PEMBIMBING (Cek dari tabel 'pembimbing')
    if ($credentials['password'] === '123456') {
        $pembimbing = DB::table('pembimbing')->where('email', $credentials['email'])->first();
        
        if ($pembimbing) {
            $userPembimbing = DB::table('users')->where('role', 'pembimbing')->first();
            if ($userPembimbing) {
                Auth::loginUsingId($userPembimbing->id);
            } else {
                $newId = DB::table('users')->insertGetId([
                    'name' => $pembimbing->nama,
                    'email' => $pembimbing->email,
                    'password' => bcrypt('123456'),
                    'role' => 'pembimbing',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                Auth::loginUsingId($newId);
            }
            $request->session()->regenerate();
            return redirect('/pembimbing');
        }
    }

       // B. BYPASS CEK UNTUK AKUN SISWA (Cek dari tabel 'users')
    if ($credentials['password'] === '123456') {
        $siswa = DB::table('users')->where('email', $credentials['email'])->where('role', 'siswa')->first();
        if ($siswa) {
            Auth::loginUsingId($siswa->id);
            $request->session()->regenerate();
            return redirect('/dashboard-siswa');
        }
        
        // TAMBAHKAN KONDISI INI: Jika ternyata yang login adalah pembimbing lewat tabel users
        $pembimbingUser = DB::table('users')->where('email', $credentials['email'])->where('role', 'pembimbing')->first();
        if ($pembimbingUser) {
            Auth::loginUsingId($pembimbingUser->id);
            $request->session()->regenerate();
            return redirect('/pembimbing'); // Lempar ke halaman pembimbing
        }
    }


    // C. JALUR LOGIN NORMAL JIKA MEMAKAI PASSWORD HASHING AMAN
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        if (Auth::user()->role === 'pembimbing') {
            return redirect('/pembimbing');
        }
        return redirect('/dashboard-siswa');
    }

    return back()->withErrors(['email' => 'Email atau password salah!']);
});


// ==========================================
// 5. PROSES KELUAR APLIKASI (LOGOUT)
// ==========================================
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


// ==========================================
// 6. JALUR PENYELAMAT: RESET DATA AKUN OTOMATIS
// ==========================================
Route::get('/buat-akun-admin', function() {
    // Sinkronisasi data tabel siswa
    DB::table('users')->updateOrInsert(
        ['email' => 'admin@gmail.com'],
        ['name' => 'Admin Magang', 'password' => bcrypt('123456'), 'role' => 'siswa', 'created_at' => now(), 'updated_at' => now()]
    );

    // Sinkronisasi data tabel khusus pembimbing
    DB::table('pembimbing')->updateOrInsert(
        ['email' => 'pembimbing@gmail.com'],
        ['nip' => '198701012026031001', 'nama' => 'Bapak Pembimbing, M.T.', 'password' => bcrypt('123456'), 'created_at' => now(), 'updated_at' => now()]
    );

    return "Data Akun Siswa & Pembimbing Berhasil Disinkronkan ke Database Baru! Silakan ke /login.";
});
