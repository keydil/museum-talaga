<x-app-layout>
    <div class="min-h-screen bg-[#fdfbf2] py-12 font-sans">
        <div class="max-w-5xl mx-auto px-6 lg:px-8" @php
    $columns = \Schema::getColumnListing('sections');
    $sejarahData = \DB::table('sections')->get();
    $lastUpdated = $sejarahData->max('updated_at');

    $sections = [];
    if (in_array('key', $columns) && in_array('content', $columns)) {
        $sections = $sejarahData->pluck('content', 'key')->toArray();
    } else {
        $firstRow = $sejarahData->first();
        $sections = [
            'sejarah_title'    => $firstRow->title ?? $firstRow->name ?? 'Sejarah Kerajaan Talaga Manggung',
            'sejarah_subtitle' => $firstRow->subtitle ?? $firstRow->abstract ?? '-',
            'sejarah_body_1'   => $firstRow->content ?? $firstRow->body ?? $firstRow->description ?? '',
            'sejarah_body_2'   => '',
            'sejarah_image'    => $firstRow->image ?? null, // Ambil data gambar dari database
        ];
    }

    $isEdit = request()->query('action') === 'edit';
@endphp>
            
            <!-- ALERT & HEADER -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-semibold">{{ session('success') }}</div>
            @endif

            <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <span class="bg-amber-100/70 border border-amber-200 text-amber-800 text-[10px] md:text-xs font-bold tracking-wider px-4 py-1.5 rounded-full mb-4 uppercase inline-block">Konfigurasi Profil</span>
                    <h1 class="text-3xl md:text-4xl font-black text-amber-700 tracking-tight">{{ $isEdit ? 'Form Kelola Teks' : 'Manajemen Teks' }} Sejarah</h1>
                </div>
                <a href="{{ $isEdit ? route('admin.sejarah.index') : route('admin.sejarah.index', ['action' => 'edit']) }}" wire:navigate 
                   class="inline-flex items-center bg-{{ $isEdit ? 'stone-200 text-stone-700' : 'amber-600 text-white' }} font-bold text-xs px-5 py-3 rounded-xl transition">
                    {{ $isEdit ? 'Kembali ke Pratinjau' : 'Ubah Narasi Sejarah' }}
                </a>
            </div>
            
<!-- Bagian Editor Header Dinamis Khusus Admin Sejarah -->
<div class="mb-8 p-6 bg-white border border-stone-200/80 rounded-2xl shadow-sm">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        
        <!-- Informasi & Pratinjau Gambar Saat Ini -->
        <div class="flex items-start sm:items-center gap-4 flex-1">
            <div class="shrink-0 relative group">
                <!-- Membaca variabel array global $banners dengan indeks 'sejarah' -->
                @if(isset($banners) && isset($banners['sejarah']))
                    <img src="{{ asset('storage/' . $banners['sejarah']) }}" 
                         alt="Header Sejarah Saat Ini" 
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
                    <span>Banner Header Sejarah</span>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-amber-50 text-amber-800 border border-amber-200">Kustom</span>
                </h3>
                <p class="text-xs text-stone-500 mt-0.5 max-w-md leading-relaxed">
                    Gambar ini akan muncul sebagai latar belakang judul utama pada halaman linimasa / narasi sejarah publik.
                </p>
            </div>
        </div>

        <!-- Form Pemilihan & Aksi Simpan untuk Admin Sejarah -->
        <form action="{{ route('admin.setting.update-header') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0">
            @csrf
            @method('PUT')
            
            <!-- 🔴 KUNCI UTAMA: Penanda halaman diatur ke 'sejarah' -->
            <input type="hidden" name="halaman" value="sejarah">
            
            <div class="relative">
                <input type="file" name="banner_image" id="banner_sejarah_input" accept="image/*" required
                       class="block w-full sm:w-64 text-xs text-stone-500 border border-stone-200 rounded-xl bg-stone-50/50 file:mr-3 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:text-xs file:font-bold file:bg-amber-600 file:text-white hover:file:bg-amber-700 cursor-pointer focus:outline-none focus:ring-1 focus:ring-amber-500 transition">
            </div>

            <button type="submit" class="inline-flex items-center justify-center space-x-2 bg-stone-800 hover:bg-stone-900 text-white font-bold text-xs px-5 py-2.5 h-[38px] rounded-xl transition duration-150 shadow-sm">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Perbarui Banner Sejarah</span>
            </button>
        </form>

    </div>
    
    <!-- Bagian Info Validasi Tambahan & Notifikasi Eror / Sukses -->
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

            @if(!$isEdit)
                <!-- VIEW MODE: INFO BOX -->
                <div class="mb-8 p-4 bg-blue-50 border border-blue-300 rounded-xl text-blue-800 text-sm font-medium flex items-start gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <strong>Konten Sejarah Sudah Statis</strong>
                        <p class="text-xs mt-1">Konten teks halaman sejarah telah diubah menjadi statis (hardcoded) dengan animasi menarik. Hanya banner header yang masih bisa diedit. Untuk mengubah konten teks, silakan hubungi developer atau ubah di file: <code class="bg-blue-100 px-1.5 py-0.5 rounded text-[11px] font-mono">resources/views/sejarah.blade.php</code></p>
                    </div>
                </div>

                <!-- VIEW MODE: METRICS & PREVIEW -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white border border-amber-200/60 p-6 rounded-2xl shadow-sm"><p class="text-[10px] font-bold text-stone-400 uppercase">Status</p><h3 class="text-xl font-black text-emerald-600 mt-1">● Terpublikasi</h3></div>
                    <div class="bg-white border border-amber-200/60 p-6 rounded-2xl shadow-sm"><p class="text-[10px] font-bold text-stone-400 uppercase">Tipe Konten</p><h3 class="text-sm font-bold text-stone-800 mt-2">Statis (Hardcoded)</h3></div>
                    <div class="bg-white border border-amber-200/60 p-6 rounded-2xl shadow-sm"><p class="text-[10px] font-bold text-stone-400 uppercase">Header</p><h3 class="text-sm font-bold text-stone-800 mt-2">Dinamis (Dapat Diedit)</h3></div>
                </div>

                <div class="bg-white border border-amber-200/60 rounded-2xl p-8 shadow-sm space-y-6">
                    <div><h4 class="text-xs font-bold text-amber-800 uppercase mb-2">ℹ️ Catatan</h4><p class="text-sm text-stone-600">Halaman Sejarah kini menampilkan konten yang telah dioptimalkan dengan animasi scroll yang indah. Header/banner masih dapat dikustomisasi melalui form di atas.</p></div>
                </div>
            @else
                <!-- EDIT MODE: Tidak digunakan lagi -->
                <div class="mb-8 p-4 bg-yellow-50 border border-yellow-300 rounded-xl text-yellow-800 text-sm font-medium flex items-start gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <strong>Mode Edit Tidak Tersedia</strong>
                        <p class="text-xs mt-1">Konten sejarah kini bersifat statis. Jika Anda ingin mengubahnya, silakan hubungi tim developer.</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
