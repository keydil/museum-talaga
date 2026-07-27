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

    <!-- 1. BILAH NAVIGASI (NAVBAR) -->
    <header class="border-b border-amber-200 bg-white/80 backdrop-blur sticky top-0 z-50 shadow-sm">
    <!-- Menggunakan flex justify-between untuk memisahkan logo (kiri) dan navigasi (kanan) -->
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between gap-4">

        <!-- SISI KIRI: Logo Web (Selalu Muncul) -->
        <div class="flex items-center font-sans tracking-wide shrink-0">
            <a href="#" class="block hover:opacity-90 transition">
                <img src="{{ Vite::asset('resources/images/image_ee43ecbd.svg') }}"
                     alt="Museum Talaga Manggung"
                     class="h-auto max-h-12 w-auto object-contain" />
            </a>
        </div>

        <!-- SISI KANAN: Menu Desktop -->
        <nav class="hidden md:flex items-center space-x-6 text-xs md:text-sm font-medium text-stone-600 whitespace-nowrap ml-auto">
            <a href="{{ url('/') }}" class="hover:text-amber-700 transition">Beranda</a>

            <!-- DROPDOWN 1: PROFIL -->
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown(event, 'menuProfil')" class="flex items-center hover:text-amber-700 transition gap-1 focus:outline-none">
                    Profil <span class="text-[9px]">▼</span>
                </button>
                <div id="menuProfil" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                    <a href="{{ route('sejarah')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Sejarah</a>
                    <a href="{{ route('visimisi')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Visi & Misi</a>
                    <a href="{{ route('strukturorg')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800">Struktur Organisasi</a>
                </div>
            </div>

            <a href="{{ route('galeri')}}" class="hover:text-amber-700 transition">Katalog</a>
            
            <!-- HIGHLIGHT BERITA DESKTOP: Otomatis berwarna amber dan semi-tebal saat halaman berita atau detail artikel aktif -->
            <a href="{{ route('berita.index') }}" class="{{ request()->routeIs('berita.*') ? 'text-amber-600 font-semibold' : 'text-stone-600' }} hover:text-amber-700 transition">Berita</a>

            <!-- DROPDOWN 2: LIVING MUSEUM -->
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown(event, 'menuMuseum')" class="flex items-center hover:text-amber-700 transition gap-1 focus:outline-none">
                    Living Museum <span class="text-[9px]">▼</span>
                </button>
                <div id="menuMuseum" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                    <a href="{{ route('walangsuji') }}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Walang Suji</a>
                    <a href="{{ route('gosali') }}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800">Gosali</a>
                </div>
            </div>
        </nav>

        <!-- SISI KANAN NYATA: Tombol Menu Hamburger untuk HP -->
        <div class="flex items-center md:hidden relative z-50">
            <button id="mobile-menu-button" type="button" class="text-stone-600 hover:text-amber-700 focus:outline-none p-2 rounded-md hover:bg-amber-50 transition" aria-label="Toggle menu">
                <svg id="hamburger-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- 1. LAPISAN BACKDROP BLUR -->
    <div id="mobile-menu-backdrop" class="hidden fixed inset-0 bg-stone-900/30 backdrop-blur-sm z-40 transition-opacity duration-300"></div>

    <!-- 2. PANEL MENU SELULER -->
    <div id="mobile-menu" class="hidden fixed top-20 left-0 right-0 md:hidden border-t border-amber-100 bg-white/95 px-6 py-4 space-y-3 text-sm font-medium text-stone-600 shadow-xl z-40 transition-all duration-300">

        <!-- MENU AKTIF SELULER: Beranda -->
        <a href="{{ url('/') }}" wire:navigate class="block hover:text-amber-700 py-1 transition">Beranda</a>

        <!-- DROPDOWN PROFIL -->
        <details class="group my-1">
            <summary class="flex items-center justify-between w-full text-sm font-medium text-stone-600 hover:text-amber-700 cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-1.5">
                    Profil 
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>

            <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
                <a href="{{ route('sejarah') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Sejarah</a>
                <a href="{{ route('visimisi') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Visi & Misi</a>
                <a href="{{ route('strukturorg') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Struktur Organisasi</a>
            </div>
        </details>

        <!-- KATALOG -->
        <a href="{{ route('galeri') }}" wire:navigate class="block hover:text-amber-700 py-1 transition">Katalog</a>
        
        <!-- HIGHLIGHT BERITA SELULER: Menggunakan font-bold dan warna amber jika rute aktif -->
        <a href="{{ route('berita.index') }}" wire:navigate class="block {{ request()->routeIs('berita.*') ? 'text-amber-500 font-bold' : 'text-stone-600' }} hover:text-amber-700 py-1 transition">Berita</a>

        <!-- DROPDOWN LIVING MUSEUM -->
        <details class="group my-1">
            <summary class="flex items-center justify-between w-full text-sm font-medium text-stone-600 hover:text-amber-700 cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-1.5">
                    Living Museum 
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>

            <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
                <a href="{{ route('walangsuji') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Walang Suji</a>
                <a href="{{ route('gosali') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Gosali</a>
            </div>
        </details>
    </div>
</header>


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
