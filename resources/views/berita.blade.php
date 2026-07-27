<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/webicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">
    <title>Profil Museum & Arsip Sejarah</title>
    <!-- Menghubungkan aset CSS & JS lokal Laravel (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Menggunakan latar belakang krem muda hangat -->
<body class="bg-amber-50 text-stone-900 antialiased font-sans min-h-screen flex flex-col">

    <!-- 1. BILAH NAVIGASI (NAVBAR) MODULAR -->
    <x-site-navbar />


    <!-- 2. KONTEN UTAMA HALAMAN BERITA -->
    
    <!-- Header Halaman -->
    <div class="w-full mb-16 overflow-hidden aspect-[3/1] md:aspect-[21/9] lg:aspect-[3.5/1] bg-stone-900 shadow-sm">
    
    <!-- Gambar Latar Belakang Dinamis Khusus Halaman Berita -->
    @if(isset($banners) && isset($banners['berita']))
        <img src="{{ asset('storage/' . $banners['berita']) }}" 
             alt="Header Banner Berita" 
             class="w-full h-full object-cover">
    @else
        <!-- Koreksi Gambar Default: Menggunakan file gambar asli khusus tema berita/koran/media -->
        <img src="https://unsplash.com" 
             alt="Default Banner Berita" 
             class="w-full h-full object-cover opacity-80">
    @endif

</div>

 <main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12">


    <!-- Komponen Search, Filter & Sortir Berita -->
<div class="mb-10 bg-white border border-amber-200/60 p-6 rounded-2xl shadow-sm">
    <form action="{{ url()->current() }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:items-end md:gap-4 justify-between">
        
        <!-- Bagian Input Pencarian Teks -->
        <div class="flex-1">
            <label Lifor="search" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Cari Artikel</label>
            <div class="relative">
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                       placeholder="Masukkan judul atau kata kunci berita..." 
                       class="w-full border border-stone-200 rounded-xl pl-10 pr-4 py-2 text-xs focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40 text-stone-700 font-medium placeholder-stone-400">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.604 10.604z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Bagian Opsi Dropdown Filter -->
        <div class="grid grid-cols-2 gap-3 sm:w-auto w-full">
            <!-- Filter Kategori -->
            <div>
                <label for="kategori" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Kategori</label>
                <select name="kategori" id="kategori" onchange="this.form.submit()" class="w-full sm:w-44 border border-stone-200 rounded-xl px-3 py-2 text-xs focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40 text-stone-700 font-medium">
                    <option value="">Semua Kategori</option>
                    <option value="Kegiatan" {{ request('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="Pengumuman" {{ request('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Penelitian" {{ request('kategori') == 'Penelitian' ? 'selected' : '' }}>Penelitian</option>
                    <option value="Event" {{ request('kategori') == 'Event' ? 'selected' : '' }}>Event</option>
                </select>
            </div>

            <!-- Urutan Rilis -->
            <div>
                <label for="urutan" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Urutan Rilis</label>
                <select name="urutan" id="urutan" onchange="this.form.submit()" class="w-full sm:w-44 border border-stone-200 rounded-xl px-3 py-2 text-xs focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40 text-stone-700 font-medium">
                    <option value="terbaru" {{ request('urutan') == 'terbaru' ? 'selected' : '' }}>Terbaru ➔ Terlama</option>
                    <option value="terlama" {{ request('urutan') == 'terlama' ? 'selected' : '' }}>Terlama ➔ Terbaru</option>
                </select>
            </div>
        </div>

        <!-- Tombol Aksi Manual (Khusus Input Pencarian) & Reset -->
        <div class="flex items-center gap-2 pt-2 md:pt-0 w-full md:w-auto">
            <button type="submit" class="w-full md:w-auto bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs px-4 py-2 rounded-xl shadow-sm transition whitespace-nowrap">
                Cari
            </button>
            @if(request('search') || request('kategori') || (request('urutan') && request('urutan') !== 'terbaru'))
                <a href="{{ url()->current() }}" class="w-full md:w-auto text-center border border-stone-200 bg-stone-50 hover:bg-stone-100 text-stone-600 font-bold text-xs px-4 py-2 rounded-xl transition whitespace-nowrap">
                    ✕ Reset
                </a>
            @endif
        </div>

    </form>
</div>


    <!-- Grid Kartu Berita -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 font-sans">

        @forelse ($berita as $item)
            <!-- Kartu Berita Dinamis -->
            <article class="bg-white border border-amber-100 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition duration-300 flex flex-col">
                <div class="h-48 bg-stone-200 relative">
                    @if($item->foto)
                        <!-- Menampilkan Foto dari Storage -->
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                    @else
                        <!-- Fallback jika tidak ada foto -->
                        <div class="absolute inset-0 flex items-center justify-center text-stone-400 font-medium text-xs">Tidak Ada Foto</div>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <!-- Kategori Berita -->
                    <span class="text-[11px] font-semibold text-amber-600 uppercase tracking-wider block mb-2">
                        {{ $item->kategori }}
                    </span>
                    
                    <!-- Judul Artikel -->
                    <h2 class="text-lg font-serif font-bold text-stone-800 tracking-tight mb-2 hover:text-amber-700 transition">
                        <a href="{{ route('berita.show', $item->id) }}">{{ $item->judul }}</a>
                    </h2>
                    
                    <!-- Ringkasan Deskripsi -->
                    <p class="text-xs text-stone-600 leading-relaxed mb-4 line-clamp-3">
                        {{ $item->ringkasan }}
                    </p>
                    
                    <div class="mt-auto pt-4 border-t border-stone-100 flex items-center justify-between text-[11px] text-stone-500">
                        <!-- Format Tanggal Indonesia (Contoh: 30 Mei 2026) -->
                        <span>{{ \Carbon\Carbon::parse($item->tanggal_publikasi)->translatedFormat('d F Y') }}</span>
                        
                        <!-- Link ke Detail Berita -->
                        <a href="{{ route('berita.show', $item->id) }}" class="font-semibold text-amber-600 hover:text-amber-800">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <!-- Tampilan jika database masih kosong -->
            <div class="col-span-full text-center py-12 text-stone-500 font-sans">
                Belum ada berita yang dipublikasikan.
            </div>
        @endforelse

    </div>
</main>

<x-site-footer />
</body>

<script>
      // ==========================================
    // 1. FUNGSI UTAMA DROPDOWN DESKTOP
    // ==========================================
    function toggleDropdown(event, menuId) {
        event.stopPropagation();

        const targetMenu = document.getElementById(menuId);
        const allMenus = document.querySelectorAll('.dropdown-list');

        // Tutup semua dropdown deskop lain terlebih dahulu
        allMenus.forEach(menu => {
            if (menu !== targetMenu) {
                menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
            }
        });

        // Toggle kelas dropdown desktop yang sedang diklik
        if (targetMenu) {
            targetMenu.classList.toggle('opacity-0');
            targetMenu.classList.toggle('invisible');
            targetMenu.classList.toggle('-translate-y-2');
            targetMenu.classList.toggle('opacity-100');
            targetMenu.classList.toggle('visible');
            targetMenu.classList.toggle('translate-y-0');
        }
    }

    // Menutup semua dropdown desktop jika pengguna mengklik di area luar mana pun
    window.addEventListener('click', function() {
        const allMenus = document.querySelectorAll('.dropdown-list');
        allMenus.forEach(menu => {
            menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
            menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
        });
    });


    // ==========================================
    // 2. FUNGSI NAVIGASI SELULER (INTEGRASI LIVEWIRE)
    // ==========================================
    function initAppNavigation() {
        const toggleBtn = document.getElementById('mobile-menu-button');
        const backdrop = document.getElementById('mobile-menu-backdrop');
        const menu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        // Batalkan inisialisasi jika elemen krusial tidak ditemukan di halaman aktif
        if (!toggleBtn || !backdrop || !menu) return;

        // Fungsi pusat untuk menutup panel seluler dan mereset status ikon
        function closeMenu() {
            menu.classList.add('hidden');
            backdrop.classList.add('hidden');
            if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
        }

        // Fungsi pusat untuk membuka/menutup panel seluler secara bergantian
        function toggleMenu() {
            const isOpen = !menu.classList.contains('hidden');
            if (isOpen) {
                closeMenu();
            } else {
                menu.classList.remove('hidden');
                backdrop.classList.remove('hidden');
                if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
                if (closeIcon) closeIcon.remove('hidden');
            }
        }

        // Membersihkan event listener lama untuk mencegah penumpukan fungsi (Memory Leak)
        toggleBtn.replaceWith(toggleBtn.cloneNode(true));
        backdrop.replaceWith(backdrop.cloneNode(true));

        // Ambil kembali referensi elemen baru setelah proses kloning pembersihan
        const cleanToggleBtn = document.getElementById('mobile-menu-button');
        const cleanBackdrop = document.getElementById('mobile-menu-backdrop');

        // Pasangkan kembali event listener tunggal yang bersih
        cleanToggleBtn.addEventListener('click', toggleMenu);
        cleanBackdrop.addEventListener('click', closeMenu);
    }

    // Jalankan inisialisasi pada pemuatan awal halaman
    document.addEventListener('DOMContentLoaded', initAppNavigation);
    
    // Wajib dijalankan ulang setiap kali Livewire memuat DOM baru via wire:navigate
    document.addEventListener('livewire:navigated', initAppNavigation);


</script>
