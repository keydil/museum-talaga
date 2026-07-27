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
                    <h1 class="text-3xl md:text-4xl font-black text-amber-700 tracking-tight">Manajemen Sejarah</h1>
                </div>
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

                <div class="bg-white border border-amber-200/60 rounded-2xl p-8 shadow-sm space-y-6">
                    <div>
                        <h4 class="text-xs font-bold text-amber-800 uppercase mb-2">ℹ️ Informasi Halaman Sejarah</h4>
                        <p class="text-sm text-stone-600">Halaman Sejarah kini telah dioptimalkan dengan alur linimasa visual modern dan animasi interaktif. Banner/header utama dapat diperbarui sewaktu-waktu melalui formulir pengunggahan di atas.</p>
                    </div>
                </div>

        </div>
    </div>
</x-app-layout>
