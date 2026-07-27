<x-app-layout>
    <div class="min-h-screen bg-[#fdfbf2] py-12 font-sans">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            <div class="mb-8">
                <a href="{{ route('admin.berita.index') }}" class="text-xs font-bold text-stone-600 hover:text-amber-700 inline-flex items-center gap-1 transition">
                    ← Kembali ke Daftar Berita
                </a>
                <h1 class="text-2xl font-black text-amber-700 tracking-tight mt-3">
                    Tambah Berita & Artikel Baru
                </h1>
            </div>

            <div class="bg-white border border-amber-200/60 rounded-2xl p-8 shadow-sm">
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Judul Berita -->
                    <div>
                        <label for="judul" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Judul Berita</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40" placeholder="Masukkan judul utama artikel...">
                        @error('judul') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Kategori</label>
                            <select name="kategori" id="kategori" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                                <option value="" disabled selected>Pilih Kategori...</option>
                                <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                <option value="Penelitian" {{ old('kategori') == 'Penelitian' ? 'selected' : '' }}>Penelitian</option>
                                <option value="Event" {{ old('kategori') == 'Event' ? 'selected' : '' }}>Event</option>
                            </select>
                            @error('kategori') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Tanggal Publikasi -->
                        <div>
                            <label for="tanggal_publikasi" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Tanggal Publikasi</label>
                            <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" value="{{ old('tanggal_publikasi', date('Y-m-d')) }}" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                            @error('tanggal_publikasi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Ringkasan -->
                    <div>
                        <label for="ringkasan" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Ringkasan Pendek (Max 500 Karakter)</label>
                        <textarea name="ringkasan" id="ringkasan" rows="3" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40" placeholder="Tuliskan deskripsi singkat atau abstrak berita...">{{ old('ringkasan') }}</textarea>
                        @error('ringkasan') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Konten Lengkap -->
                    <div>
                        <label for="konten_lengkap" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Konten Lengkap Berita</label>
                        <textarea name="konten_lengkap" id="konten_lengkap" rows="8" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40" placeholder="Tulis keseluruhan isi artikel di sini...">{{ old('konten_lengkap') }}</textarea>
                        @error('konten_lengkap') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Upload Foto -->
                    <div>
                        <label for="foto" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Foto / Banner Berita</label>
                        <input type="file" name="foto" id="foto" class="w-full text-xs text-stone-500 border border-stone-200 rounded-xl bg-stone-50/40 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:text-xs file:font-bold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200">
                        <p class="text-[11px] text-stone-400 mt-1">Format: JPEG, PNG, JPG, GIF. Ukuran maksimum berkas: 2MB.</p>
                        @error('foto') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 border-t border-stone-100 flex gap-3">
                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow-sm transition">
                            Simpan & Terbitkan
                        </button>
                        <a href="{{ route('admin.berita.index') }}" class="bg-stone-100 hover:bg-stone-200 text-stone-600 font-bold text-xs px-6 py-2.5 rounded-xl transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
