<?php

namespace App\Http\Controllers;

use App\Models\Guestbook; // <-- Tambahkan ini
use Illuminate\Http\Request; // <-- Tambahkan ini

class GuestbookController extends Controller
{
    /**
     * Display a listing of the resource. (READ)
     */
    public function index()
    {
        // Ambil semua data guestbook dan kirim ke view
        $guestbooks = Guestbook::all();
        return view('guestbook.index', compact('guestbooks'));
    }

    /**
     * Show the form for creating a new resource. (CREATE)
     */
    public function create()
    {
        // Tampilkan halaman form tambah data
        return view('guestbook.create');
    }

    /**
     * Store a newly created resource in storage. (CREATE)
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Simpan data ke database
        Guestbook::create([
            'name' => $request->name,
            'message' => $request->message,
        ]);

        // Arahkan kembali ke halaman index
        return redirect()->route('guestbook.index')->with('success', 'Pesan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource. (UPDATE)
     */
    public function edit(Guestbook $guestbook)
    {
        // Tampilkan form edit dengan data yang sudah ada
        return view('guestbook.edit', compact('guestbook'));
    }

    /**
     * Update the specified resource in storage. (UPDATE)
     */
    public function update(Request $request, Guestbook $guestbook)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Update data di database
        $guestbook->update([
            'name' => $request->name,
            'message' => $request->message,
        ]);

        // Arahkan kembali ke halaman index
        return redirect()->route('guestbook.index')->with('success', 'Pesan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage. (DELETE)
     */
    public function destroy(Guestbook $guestbook)
    {
        // Hapus data
        $guestbook->delete();
        
        // Arahkan kembali ke halaman index
        return redirect()->route('guestbook.index')->with('success', 'Pesan berhasil dihapus.');
    }
}