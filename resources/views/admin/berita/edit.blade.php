<x-app-layout>
    <div class="min-h-screen bg-[#fdfbf2] py-12 font-sans">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            <div class="mb-8">
                <a href="{{ route('admin.berita.index') }}" class="text-xs font-bold text-stone-600 hover:text-amber-700 inline-flex items-center gap-1 transition">
                    ← Kembali ke Daftar Berita
                </a>
                <h1 class="text-2xl font-black text-amber-700 tracking-tight mt-3">
                    Perbarui Berita: {{ $berita->judul }}
                </h1>
            </div>

            <div class="bg-white border border-amber-200/60 rounded-2xl p-8 shadow-sm">
                <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Judul Berita -->
                    <div>
                        <label for="judul" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Judul Berita</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                        @error('judul') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Kategori</label>
                            <select name="kategori" id="kategori" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                                @foreach(['Kegiatan', 'Pengumuman', 'Penelitian', 'Event'] as $cat)
                                    <option value="{{ $cat }}" {{ old('kategori', $berita->kategori) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            @error('kategori') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Tanggal Publikasi -->
                        <div>
                            <label for="tanggal_publikasi" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Tanggal Publikasi</label>
                            <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" value="{{ old('tanggal_publikasi', \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('Y-m-d')) }}" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                            @error('tanggal_publikasi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Ringkasan -->
                    <div>
                        <label for="ringkasan" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Ringkasan Pendek (Max 500 Karakter)</label>
                        <textarea name="ringkasan" id="ringkasan" rows="3" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                        @error('ringkasan') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Konten Lengkap -->
                    <div>
                        <label for="konten_lengkap" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Konten Lengkap Berita</label>
                        <textarea name="konten_lengkap" id="konten_lengkap" rows="8" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">{{ old('konten_lengkap', $berita->konten_lengkap) }}</textarea>
                        @error('konten_lengkap') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Upload Foto -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Foto Saat Ini</label>
                        @if($berita->foto)
                            <div class="mb-3">
                                @php
                                    $imgSrcBerita = \Illuminate\Support\Str::startsWith($berita->foto, 'http') 
                                        ? $berita->foto 
                                        : (\Illuminate\Support\Str::startsWith($berita->foto, 'images/') 
                                            ? asset($berita->foto) 
                                            : (\Illuminate\Support\Str::startsWith($berita->foto, 'storage/') 
                                                ? asset($berita->foto) 
                                                : asset('storage/' . $berita->foto)));
                                @endphp
                                <img id="image_preview_berita" src="{{ $imgSrcBerita }}" alt="Current Photo" class="w-40 h-40 object-cover rounded-xl border border-stone-200 shadow-sm bg-stone-50">
                            </div>
                        @endif

                        <label for="foto" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Ganti Foto Baru (Opsional)</label>
                        <input type="file" name="foto" id="foto" accept="image/*" class="w-full text-xs text-stone-500 border border-stone-200 rounded-xl bg-stone-50/40 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:text-xs file:font-bold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer">
                        @error('foto') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 border-t border-stone-100 flex gap-3">
                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow-sm transition">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.berita.index') }}" class="bg-stone-100 hover:bg-stone-200 text-stone-600 font-bold text-xs px-6 py-2.5 rounded-xl transition">
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
                    const img = document.getElementById('image_preview_berita');
                    if (img) img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
