<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // Halaman Galeri Publik (Untuk Pengunjung Website) + Filter Kategori & Cari
    public function index(Request $request)
    {
        $kataKunci = $request->input('search');
        $kategoriTerpilih = $request->input('kategori');

        // Ambil daftar kategori unik dari database secara dinamis
        $kategoriList = Galeri::select('kategori')->distinct()->whereNotNull('kategori')->pluck('kategori');

        $galeri = Galeri::query()
            ->when($kataKunci, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%')
                      ->orWhere('kategori', 'like', '%' . $search . '%');
                });
            })
            ->when($kategoriTerpilih, function ($query, $kategori) {
                return $query->where('kategori', $kategori);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('galeri', compact('galeri', 'kataKunci', 'kategoriTerpilih', 'kategoriList'));
    }

    public function show(Galeri $galeri)
    {
        $related = Galeri::query()
            ->where('kategori', $galeri->kategori)
            ->where('id', '!=', $galeri->id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('galeri.show', compact('galeri', 'related'));
    }

    // =====================================================
    // ADMIN METHODS
    // =====================================================

    // Menampilkan Dashboard Tabel Galeri Admin
    public function adminIndex()
    {
        $galeris = Galeri::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.galeri.index', compact('galeris'));
    }

    // Form Tambah Foto Galeri
    public function create()
    {
        return view('admin.galeri.create');
    }

    // Simpan Foto Galeri Baru
    public function store(Request $request)
    {
        $validated = $request->validate([
    'judul' => 'required|string|max:255',
    'deskripsi' => 'nullable|string|max:1000',
    'kategori' => 'required|string|max:100',
    'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048',
    'link_3d' => 'nullable|url', // <-- Validasi wajib berupa format link URL valid
]);


        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('galeri', 'public');
            $validated['foto'] = $path;
        }

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri baru berhasil diunggah!');
    }

    // Form Edit Foto Galeri
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    // Perbarui Data Foto Galeri
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
    'judul' => 'required|string|max:255',
    'deskripsi' => 'nullable|string|max:1000',
    'kategori' => 'required|string|max:100',
    'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048',
    'link_3d' => 'nullable|url', // <-- Validasi wajib berupa format link URL valid
]);


        if ($request->hasFile('foto')) {
            if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $path = $request->file('foto')->store('galeri', 'public');
            $validated['foto'] = $path;
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Data galeri berhasil diperbarui!');
    }

    // Hapus Foto Galeri
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}