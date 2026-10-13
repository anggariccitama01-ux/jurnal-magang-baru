<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pembimbing; 
use App\Models\User;

class ProfilController extends Controller
{
    // 1. Menampilkan halaman profil sesuai role (Siswa / Pembimbing)
    public function show()
    {
        $user = Auth::user();

        // Jika yang masuk adalah akun siswa
        if ($user && $user->role === 'siswa') {
            $pembimbing = $user->pembimbing;
            $daftar_pembimbing \App\Models\Pembimbing::all();

            return view('profil_siswa', compact('user', 'pembimbing', 'daftar_pembimbing'));
        }

        // Jika yang masuk adalah akun pembimbing
        return view('profil_pembimbing', compact('user'));
    }

    // 2. Memproses pembaruan data profil dan upload foto
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input form
        $request->validate([
            'name'          => 'required|string|max:255',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Batas file foto maks 2MB
            'pembimbing_id' => 'nullable|exists:pembimbing,id', // Validasi pilihan pembimbing untuk siswa
        ]);

        // Siapkan data dasar yang mau diubah
        $userModel = User::findOrFail($user->id);
        $userModel->name = $request->name;

        // Logika upload foto jika user memilih file gambar baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama di folder storage jika ada agar tidak memenuhi disk
            if ($userModel->foto) {
                Storage::disk('public')->delete($userModel->foto);
            }
            
            // Simpan foto baru ke folder storage/app/public/avatars
            $path = $request->file('foto')->store('avatars', 'public');
            $userModel->foto = $path;
        }

        // Khusus Akun Siswa: update data ID pembimbing pendampingnya jika dipilih
        if ($user->role === 'siswa' && $request->has('pembimbing_id')) {
            $userModel->pembimbing_id = $request->pembimbing_id;
        }

        // Simpan semua perubahan ke tabel users
        $userModel->save();

        // Khusus Akun Pembimbing: sinkronisasikan juga nama & foto ke tabel pembimbing
        if ($user->role === 'pembimbing') {
            $pembimbingModel = Pembimbing::where('email', $user->email)->first();
            if ($pembimbingModel) {
                $pembimbingModel->nama = $request->name;
                if ($request->hasFile('foto')) {
                    $pembimbingModel->foto = $userModel->foto;
                }
                $pembimbingModel->save();
            }
        }

        return redirect()->back()->with('success', 'Profil dan foto berhasil diperbarui!');
    }
}
