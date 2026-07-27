<x-app-layout>
    <div class="min-h-screen bg-[#fdfbf2] py-12 font-sans">
        <div class="max-w-3xl mx-auto px-6 lg:px-8">
            
            <div class="mb-8">
                <a href="{{ route('admin.galeri.index') }}" class="text-xs font-bold text-stone-600 hover:text-amber-700 inline-flex items-center gap-1 transition">
                    ← Kembali ke Manajemen Katalog
                </a>
                <h1 class="text-2xl font-black text-amber-700 tracking-tight mt-3">
                    Edit Aset: {{ $galeri->judul }}
                </h1>
            </div>

            <div class="bg-white border border-amber-200/60 rounded-2xl p-8 shadow-sm">
                <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Objek -->
                    <div>
                        <label for="judul" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Nama Artefak / Kegiatan</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $galeri->judul) }}" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                        @error('judul') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Klasifikasi Kategori -->
                    <div>
                        <label for="kategori" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Klasifikasi Kategori</label>
                        <select name="kategori" id="kategori" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                            @foreach(['Arca Perunggu', 'Terracotta', 'Perlengkapan Ritual', 'Senjata Tradisional', 'Senjata Berpeledak', 'Pakaian Perlengkapan Perang', 'Etnografika', 'Keramokologika', 'Numismatika'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $galeri->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Link Model 3D -->
                    <div>
                        <label for="link_3d" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Tautan Integasi Objek 3D (Opsional)</label>
                        <input type="url" name="link_3d" id="link_3d" value="{{ old('link_3d', $galeri->link_3d) }}" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                        @error('link_3d') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Konteks Sejarah / Deskripsi Ringkas</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                        @error('deskripsi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Foto Media Saat Ini & Input File Baru -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Pratinjau Gambar Saat Ini</label>
                        <div class="mb-4">
                            @php
                                $imgSrc = \Illuminate\Support\Str::startsWith($galeri->foto, 'http') 
                                    ? $galeri->foto 
                                    : (\Illuminate\Support\Str::startsWith($galeri->foto, 'images/') 
                                        ? asset($galeri->foto) 
                                        : (\Illuminate\Support\Str::startsWith($galeri->foto, 'storage/') 
                                            ? asset($galeri->foto) 
                                            : asset('storage/' . $galeri->foto)));
                            @endphp
                            <img id="image_preview" src="{{ $imgSrc }}" alt="Preview" class="w-40 h-40 object-cover rounded-xl border border-stone-200 shadow-sm bg-stone-50">
                        </div>

                        <label for="foto" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Ganti Gambar Baru (Opsional)</label>
                        <input type="file" name="foto" id="foto" accept="image/*" class="w-full text-xs text-stone-500 border border-stone-200 rounded-xl bg-stone-50/40 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:text-xs file:font-bold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer">
                        @error('foto') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tombol Form -->
                    <div class="pt-4 border-t border-stone-100 flex gap-3">
                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow-sm transition">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.galeri.index') }}" class="bg-stone-100 hover:bg-stone-200 text-stone-600 font-bold text-xs px-6 py-2.5 rounded-xl transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('foto')?.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('image_preview');
                    if (img) img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>