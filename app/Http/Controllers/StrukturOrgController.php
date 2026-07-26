<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position; 
use Illuminate\Support\Facades\Storage;

class StrukturOrgController extends Controller
{
    /**
     * Menampilkan halaman index editor struktur organisasi di panel admin.
     */
   public function index()
{
    // KOREKSI: Harus mencari data 'Global' agar sama dengan data yang disimpan
    $struktur = Position::where('title', 'Global')->first(); 

    // Mengarah ke file view admin Anda
    return view('admin.strukturorg.index', compact('struktur'));
}


    /**
     * Memproses penyimpanan pembaruan berkas gambar dan teks deskripsi.
     */
    public function update(Request $request)
    {
        // 1. Validasi input form (memastikan file gambar wajib ada pada pembuatan pertama)
        $isExist = Position::where('title', 'Global')->exists();
        
        $request->validate([
            'struktur_image' => $isExist ? 'nullable|image|mimes:jpeg,png,jpg,jpeg,webp|max:2048' : 'required|image|mimes:jpeg,png,jpg,jpeg,webp|max:2048',
        ]);

        // 2. Ambil data dengan pencarian kriteria spesifik 'Global'
        $struktur = Position::where('title', 'Global')->first();

        // Jika data belum ada, paksa instansiasi objek baru secara manual
        if (!$struktur) {
            $struktur = new Position();
            $struktur->title = 'Global'; 
            $struktur->role = 'Museum';
        }

        // 3. Proses penyimpanan berkas file gambar fisik ke dalam storage publik
        if ($request->hasFile('struktur_image')) {
            if ($struktur->image && Storage::disk('public')->exists($struktur->image)) {
                Storage::disk('public')->delete($struktur->image);
            }
            
            $path = $request->file('struktur_image')->store('struktur_org', 'public');
            $struktur->image = $path; 
        }

        // 4. Masukkan data teks deskripsi langsung ke properti kolom description database jika ada
        if ($request->filled('deskripsi')) {
            $struktur->description = $request->deskripsi;
        }
        
        // 5. Eksekusi penyimpanan final database
        $struktur->save();

        // 6. Alihkan rute kembali ke halaman manajemen index admin utama Anda
        return redirect()->route('admin.strukturorg.index')->with('success', 'Data bagan gambar dan teks deskripsi organisasi berhasil diperbarui!');
    }
}
