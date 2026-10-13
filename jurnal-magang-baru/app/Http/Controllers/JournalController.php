<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    // 1. Menampilkan semua daftar jurnal (Hanya untuk Siswa)
    public function index()
    {
        // JIKA YANG MASUK ADALAH PEMBIMBING, LEMPAR OTOMATIS KE HALAMAN PEMBIMBING
        if (auth()->check() && auth()->user()->role === 'pembimbing') {
            return redirect()->route('pembimbing.index');
        }

        $journals = Journal::orderBy('tanggal', 'desc')->get();
        return view('journals.index', compact('journals'));
    }

    // 2. Menampilkan halaman form tambah jurnal
    public function create()
    {
        return view('journals.create');
    }

    // 3. Menyimpan data jurnal baru ke database MySQL
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required',
        ]);

        Journal::create($request->all());

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil ditambahkan!');
    }

    // 4. Menampilkan halaman form edit dengan data jurnal lama
    public function edit($id)
    {
        $journal = Journal::findOrFail($id);
        return view('journals.edit', compact('journal'));
    }

    // 5. Menyimpan perubahan data jurnal dari halaman edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required',
        ]);

        $journal = Journal::findOrFail($id);
        $journal->update($request->all());

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil diperbarui!');
    }

    // 6. Menghapus data jurnal dari database
    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil dihapus!');
    }

    // 7. Menampilkan halaman khusus semua jurnal untuk pembimbing
    public function pembimbingIndex()
    {
        $journals = Journal::latest()->get();
        return view('journals.pembimbing', compact('journals'));
    }

    // 8. Menyimpan catatan/komentar dari pembimbing ke database
    public function pembimbingKomentar(Request $request, $id)
    {
        $request->validate([
            'catatan_pembimbing' => 'required',
        ]);

        $journal = Journal::findOrFail($id);
        $journal->update([
            'catatan_pembimbing' => $request->catatan_pembimbing
        ]);

        return redirect()->route('pembimbing.index')->with('success', 'Catatan pembimbing berhasil disimpan!');
    }

    // 9. Mengubah status kendala mahasiswa (Terima / Tolak)
    public function updateStatus($id, $status)
    {
        $journal = Journal::findOrFail($id);

        if (in_array($status, ['lancar', 'bermasalah'])) {
            $journal->kendala = $status;
            $journal->save();

            return redirect()->back()->with('success', 'Status validasi kegiatan mahasiswa berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Status tidak valid.');
    }
}
