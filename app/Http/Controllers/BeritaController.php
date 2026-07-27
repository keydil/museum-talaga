<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Menampilkan daftar berita di halaman utama (PUBLIC) dengan fitur Filter & Sortir
    public function index(Request $request)
{
    // Tangkap input parameter dari URL (?search=...&kategori=...&urutan=...)
    $kataKunci = $request->input('search');
    $kategoriTerpilih = $request->input('kategori');
    $urutkanTanggal = $request->input('urutan', 'terbaru'); // Default: terbaru

    $berita = Berita::query()
        // 1. Fitur Pencarian (Mencari teks di judul atau ringkasan)
        ->when($kataKunci, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('ringkasan', 'like', '%' . $search . '%');
            });
        })
        // 2. Fitur Filter Kategori
        ->when($kategoriTerpilih, function ($query, $kategori) {
            return $query->where('kategori', $kategori);
        })
        // 3. Fitur Urutan Tanggal (Terbaru atau Terlama)
        ->when($urutkanTanggal, function ($query, $urutan) {
            if ($urutan === 'terlama') {
                return $query->orderBy('tanggal_publikasi', 'asc');
            }
            return $query->orderBy('tanggal_publikasi', 'desc');
        })
        ->get();

    // Kirim semua variabel ke view agar status form input/select tetap terjaga saat submit
    return view('berita', compact('berita', 'kataKunci', 'kategoriTerpilih', 'urutkanTanggal'));
}

    // Menampilkan detail berita individual (PUBLIC)
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        $beritaTerkait = Berita::where('kategori', $berita->kategori)
            ->where('id', '!=', $berita->id)
            ->orderBy('tanggal_publikasi', 'desc')
            ->limit(2)
            ->get();
        return view('berita.show', compact('berita', 'beritaTerkait'));
    }

    // ADMIN METHODS BELOW
    // =====================================================

    // BARU: Menampilkan tabel kelola berita khusus halaman admin
    public function adminIndex()
    {
        $beritas = Berita::orderBy('tanggal_publikasi', 'desc')->paginate(10); 
        return view('admin.berita.index', compact('beritas'));
    }

    // Tampilkan form untuk membuat berita baru (ADMIN)
    public function create()
    {
        return view('admin.berita.create');
    }

    // Simpan berita baru ke database (ADMIN)
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'required|string|max:500',
            'konten_lengkap' => 'required|string',
            'kategori' => 'required|string|max:100',
            'tanggal_publikasi' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('berita', 'public');
            $validated['foto'] = $path;
        }

        // Buat berita baru
        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dibuat!');
    }

    // Tampilkan form untuk mengedit berita (ADMIN)
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    // Update berita di database (ADMIN)
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'required|string|max:500',
            'konten_lengkap' => 'required|string',
            'kategori' => 'required|string|max:100',
            'tanggal_publikasi' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }
            $path = $request->file('foto')->store('berita', 'public');
            $validated['foto'] = $path;
        }

        // Update berita
        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // Hapus berita dari database (ADMIN)
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus foto jika ada
        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }

        // Hapus berita
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function updateHeader(Request $request)
    {
        $request->validate([
            'header_galeri' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $setting = Setting::first() ?? new Setting();

        if ($request->hasFile('header_galeri')) {
            if ($setting->header_galeri && Storage::disk('public')->exists($setting->header_galeri)) {
                Storage::disk('public')->delete($setting->header_galeri);
            }

            $path = $request->file('header_galeri')->store('headers', 'public');
            $setting->header_galeri = $path;
        }

        $setting->save();

        return redirect()->back()->with('success_header', 'Banner header galeri berhasil diperbarui!');
    }
}


