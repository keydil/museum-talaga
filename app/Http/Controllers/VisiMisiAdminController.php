<?php

namespace App\Http\Controllers;

use App\Models\Visimisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisiMisiAdminController extends Controller
{
    public function index()
    {
        // Ambil baris data pertama, jika belum ada buat data tiruan kosong
        $visimisi = Visimisi::first() ?: new Visimisi();
        return view('admin.visimisi.index', compact('visimisi'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:500',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $visimisi = Visimisi::first() ?: new Visimisi();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada berkas baru
            if ($visimisi->image) {
                Storage::disk('public')->delete($visimisi->image);
            }
            $validated['image'] = $request->file('image')->store('visimisi', 'public');
        }

        // Simpan data ke satu baris tunggal di database
        $visimisi->fill($validated);
        $visimisi->save();

        return redirect()->route('admin.visimisi.index')->with('success', 'Visi & Misi museum berhasil diperbarui!');
    }
}
