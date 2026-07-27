<x-app-layout>



<!-- Konten Pembungkus Utama Admin -->
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
       
            <!-- Bagian Editor Header Dinamis Khusus Admin Struktur Organisasi -->
    <div class="mb-8 p-6 bg-white border border-stone-200/80 rounded-2xl shadow-sm">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            
            <!-- Informasi & Pratinjau Gambar Saat Ini -->
            <div class="flex items-start sm:items-center gap-4 flex-1">
                <div class="shrink-0 relative group">
                    @if(isset($banners) && isset($banners['strukturorg']))
                        <img src="{{ asset('storage/' . $banners['strukturorg']) }}" 
                             alt="Header Struktur Organisasi Saat Ini" 
                             class="w-32 h-20 object-cover rounded-xl border border-stone-200 shadow-sm bg-stone-50">
                    @else
                        <div class="w-32 h-20 bg-stone-100 rounded-xl border border-dashed border-stone-300 flex flex-col items-center justify-center text-center p-2">
                            <svg class="h-5 w-5 text-stone-400 mb-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H2.25A1.5 1.5 0 00.75 6v12.75a1.5 1.5 0 001.5 1.5z" />
                            </svg>
                            <span class="text-[9px] font-medium text-stone-400">Gambar Default</span>
                        </div>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-bold text-stone-800 flex items-center gap-1.5">
                        <span>Banner Header Struktur Organisasi</span>
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-amber-50 text-amber-800 border border-amber-200">Kustom</span>
                    </h3>
                    <p class="text-xs text-stone-500 mt-0.5 max-w-md leading-relaxed">
                        Gambar ini akan muncul sebagai latar belakang judul utama pada halaman bagan dan profil kepengurusan museum.
                    </p>
                </div>
            </div>

            <!-- Form Pemilihan & Aksi Simpan untuk Admin Struktur Organisasi -->
            <form action="{{ route('admin.setting.update-header') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="halaman" value="strukturorg">
                
                <div class="relative">
                    <input type="file" name="banner_image" id="banner_strukturorg_input" accept="image/*" required
                           class="block w-full sm:w-64 text-xs text-stone-500 border border-stone-200 rounded-xl bg-stone-50/50 file:mr-3 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:text-xs file:font-bold file:bg-amber-600 file:text-white hover:file:bg-amber-700 cursor-pointer focus:outline-none focus:ring-1 focus:ring-amber-500 transition">
                </div>

                <button type="submit" class="inline-flex items-center justify-center space-x-2 bg-stone-800 hover:bg-stone-900 text-white font-bold text-xs px-5 py-2.5 h-[38px] rounded-xl transition duration-150 shadow-sm">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Perbarui Banner Struktur</span>
                </button>
            </form>

        </div>
        
        <div class="mt-3 pt-3 border-t border-stone-100 flex flex-col sm:flex-row sm:items-center sm:justify-between text-[11px] gap-2">
            <span class="text-stone-400">Rekomendasi rasio lebar 3:1 (Maksimal 2MB, format .jpg, .png, .webp).</span>
            
            @if(session('success_header'))
                <span class="text-emerald-600 font-semibold bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">{{ session('success_header') }}</span>
            @endif

            @error('banner_image')
                <span class="text-red-600 font-semibold bg-red-50 px-2.5 py-1 rounded-md border border-red-200">{{ $message }}</span>
            @enderror
        </div>
    </div>

        <!-- Info Box: Konten Sudah Statis -->
        <div class="mb-8 p-4 bg-blue-50 border border-blue-300 rounded-xl text-blue-800 text-sm font-medium flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <strong>Konten Struktur Organisasi Sudah Statis</strong>
                <p class="text-xs mt-1">Konten teks halaman struktur organisasi telah diubah menjadi statis (hardcoded) dengan animasi menarik dan layout grid divisi. Hanya banner header dan gambar bagan yang masih bisa diedit. Untuk mengubah konten teks deskripsi, silakan hubungi developer atau ubah di file: <code class="bg-blue-100 px-1.5 py-0.5 rounded text-[11px] font-mono">resources/views/strukturorg.blade.php</code></p>
            </div>
        </div>

        <!-- Form: Hanya untuk Upload Gambar Bagan (Deskripsi dihapus) -->
        <form action="{{ route('admin.strukturorg.update') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              wire:submit.default 
              class="space-y-6">
              
            @csrf
            @method('PUT')

            <!-- Bagian 1: Edit & Upload Gambar Struktur -->
            <div class="p-6 bg-white border border-stone-200/80 rounded-2xl shadow-sm">
                <h3 class="text-sm font-bold text-stone-800 flex items-center gap-1.5 mb-4">
                    <span>🖼️ Gambar Bagan Struktur Organisasi</span>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-amber-50 text-amber-800 border border-amber-200">Wajib .png/.jpg</span>
                </h3>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Kolom Pratinjau Gambar (Kiri) -->
                    <div class="lg:col-span-1 flex flex-col items-center justify-center p-4 bg-stone-50 rounded-xl border border-stone-200 min-h-[200px]">
                        <span class="text-xs font-semibold text-stone-500 mb-3 block text-center">Pratinjau Bagan Saat Ini</span>
                        
                        <div class="relative group w-full flex justify-center">
                            @if(isset($struktur) && isset($struktur->image))
                                <img id="bagan_preview" src="{{ asset('storage/' . $struktur->image) }}" 
                                     alt="Bagan Struktur Organisasi" 
                                     class="max-h-48 object-contain rounded-xl border border-stone-200 shadow-sm bg-white">
                            @else
                                <img id="bagan_preview" src="#" alt="Pratinjau Baru" 
                                     class="hidden max-h-48 object-contain rounded-xl border border-stone-200 shadow-sm bg-white">
                                <div id="bagan_placeholder" class="w-full h-40 bg-stone-100 rounded-xl border border-dashed border-stone-300 flex flex-col items-center justify-center text-center p-4">
                                    <svg class="h-8 w-8 text-stone-400 mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H2.25A1.5 1.5 0 00.75 6v12.75a1.5 1.5 0 001.5 1.5z" />
                                    </svg>
                                    <span class="text-xs font-medium text-stone-400">Belum ada bagan diunggah</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Unggah File (Kanan) -->
                    <div class="lg:col-span-2 flex flex-col justify-center">
                        <label class="block text-xs font-bold text-stone-700 mb-2">Pilih File Bagan Baru</label>
                        <div class="relative">
                            <input type="file" name="struktur_image" id="bagan_input" accept="image/png, image/jpeg, image/jpg"
                                   class="block w-full text-xs text-stone-500 border border-stone-200 rounded-xl bg-stone-50/50 file:mr-3 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:text-xs file:font-bold file:bg-amber-600 file:text-white hover:file:bg-amber-700 cursor-pointer focus:outline-none focus:ring-1 focus:ring-amber-500 transition">
                        </div>
                        <p class="text-[11px] text-stone-400 mt-2 leading-relaxed">
                            Pilih berkas gambar bagan organisasi dengan format <strong>.png</strong>, <strong>.jpg</strong>, atau <strong>.jpeg</strong> (Maksimal 2MB).
                        </p>
                        @error('struktur_image')
                            <span class="text-red-600 text-[11px] font-semibold bg-red-50 px-2.5 py-1 rounded-md border border-red-200 mt-2 inline-block w-max">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Bagian Info Notifikasi & Tombol Aksi Utama -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-4 bg-stone-50 rounded-2xl border border-stone-200">
                <div>
                    @if(session('success'))
                        <span class="text-emerald-600 text-xs font-semibold bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200 inline-block">{{ session('success') }}</span>
                    @else
                        <span class="text-stone-400 text-xs">Pastikan gambar bagan telah diperiksa sebelum menekan tombol simpan.</span>
                    @endif
                </div>

                <div class="flex items-center gap-3 shrink-0 self-end sm:self-auto">
                    <button type="button" onclick="window.location.reload();" class="inline-flex items-center justify-center bg-white border border-stone-200 hover:bg-stone-100 text-stone-700 font-bold text-xs px-5 py-2.5 h-[38px] rounded-xl transition duration-150 shadow-sm">
                        Batal
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center space-x-2 bg-stone-800 hover:bg-stone-900 text-white font-bold text-xs px-5 py-2.5 h-[38px] rounded-xl transition duration-150 shadow-sm">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>Simpan Gambar Bagan</span>
                    </button>
                </div>
            </div>

        </form>
    </div>


    <!-- Script JavaScript Pratinjau Gambar -->
    <script>
        document.getElementById('bagan_input').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                const preview = document.getElementById('bagan_preview');
                const placeholder = document.getElementById('bagan_placeholder');

                reader.onload = function(e) {
                    preview.setAttribute('src', e.target.result);
                    preview.classList.remove('hidden');
                    if(placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    
</x-app-layout>
