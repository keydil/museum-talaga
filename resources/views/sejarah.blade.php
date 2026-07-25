<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Museum & Arsip Sejarah</title>
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

            <!-- DROPDOWN 1: PROFIL (DESKTOP HIGHLIGHT STRUKTUR ORGANISASI) -->
            <div class="relative inline-block text-left">
                <!-- Tombol utama 'Profil' ikut berwarna amber saat sub-menu Struktur Organisasi aktif -->
                <button onclick="toggleDropdown(event, 'menuProfil')" class="flex items-center {{ request()->routeIs('sejarah') ? 'text-amber-600 font-semibold' : '' }} hover:text-amber-700 transition gap-1 focus:outline-none">
                    Profil <span class="text-[9px]">▼</span>
                </button>
                <div id="menuProfil" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                    <a href="{{ route('sejarah')}}" class="block px-4 py-2.5 text-xs  {{ request()->routeIs('sejarah') ? 'bg-amber-50 text-amber-600 font-bold border-l-4 border-amber-500' : 'text-stone-700' }}  hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Sejarah</a>
                    <a href="{{ route('visimisi')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Visi & Misi</a>
                    
                    <!-- HIGHLIGHT STRUKTUR ORGANISASI DESKTOP -->
                    <a href="{{ route('strukturorg')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800">Struktur Organisasi</a>
                </div>
            </div>

            <a href="{{ route('galeri')}}" class="hover:text-amber-700 transition">Katalog</a>
            <a href="{{ route('berita.index') }}" class="hover:text-amber-700 transition">Berita</a>

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

        <!-- DROPDOWN PROFIL (SELULER HIGHLIGHT STRUKTUR ORGANISASI) -->
        <!-- Otomatis menambahkan atribut 'open' jika rute strukturorg aktif agar langsung menggelar terbuka -->
        <details class="group my-1">
            <summary class="flex items-center justify-between w-full text-sm font-medium hover:text-amber-700 cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-1.5">
                    Profil 
                </span>
                <svg xmlns="http://w3.org" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>

           <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
    <!-- SEJARAH AKTIF -->
    <a href="{{ route('sejarah') }}" wire:navigate 
       class="block text-xs transition text-amber-600 font-bold border-l-2 border-amber-500 -ml-[17px] pl-[15px]">
       Sejarah
    </a>
    
    <a href="{{ route('visimisi') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Visi & Misi</a>
    <a href="{{ route('strukturorg') }}" wire:navigate class="block hover:text-amber-700 text-xs transition">Struktur Organisasi</a>
</div>

        </details>

        <!-- KATALOG & BERITA -->
        <a href="{{ route('galeri') }}" wire:navigate class="block hover:text-amber-700 py-1 transition">Katalog</a>
        <a href="{{ route('berita.index') }}" wire:navigate class="block hover:text-amber-700 py-1 transition">Berita</a>

        <!-- DROPDOWN LIVING MUSEUM -->
        <details class="group my-1">
            <summary class="flex items-center justify-between w-full text-sm font-medium text-stone-600 hover:text-amber-700 cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-1.5">
                    Living Museum 
                </span>
                <svg xmlns="http://w3.org" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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


<!-- 2. KONTEN UTAMA: HALAMAN SEJARAH DINAMIS -->
<div class="w-full mb-16 overflow-hidden aspect-[3/1] md:aspect-[21/9] lg:aspect-[3.5/1] bg-stone-900 shadow-sm">
    
    <!-- Gambar Latar Belakang Dinamis Khusus Halaman Sejarah -->
    <!-- 🔴 Mengambil data khusus array key 'sejarah' -->
    @if(isset($banners) && isset($banners['sejarah']))
        <img src="{{ asset('storage/' . $banners['sejarah']) }}" 
             alt="Header Banner Sejarah" 
             class="w-full h-full object-cover">
    @else
        <!-- Gambar Default bertema teks/manuskrip/arsip sejarah lama jika admin belum upload -->
        <img src="https://unsplash.com" 
             alt="Default Banner Sejarah" 
             class="w-full h-full object-cover opacity-80">
    @endif

</div>

<main class="flex-grow max-w-4xl w-full mx-auto px-6 py-12 bg-[#fdfbf2] font-sans">
    
    <!-- Bagian Judul dan Abstrak Sejarah -->
    {{-- <div class="text-center mb-12 flex flex-col items-center" data-aos="fade-down" data-aos-duration="800">
        <h1 class="text-3xl md:text-5xl font-black text-amber-800 tracking-tight leading-tight">
            {{ $sejarahData['sejarah_title'] ?? 'Sejarah Kerajaan Talaga Manggung' }}
        </h1>
        <p class="mt-4 text-stone-600 text-sm md:text-base leading-relaxed max-w-2xl italic">
            "{{ $sejarahData['sejarah_subtitle'] ?? 'Menelusuri jejak luhur peradaban, titisan benda pusaka, dan kronik kegemilangan masa lalu institusi.' }}"
        </p>
        <div class="h-0.5 w-16 bg-amber-600 rounded-full mt-6"></div>
    </div> --}}

    <!-- Wadah Artikel Narasi Panjang -->
    <div class="bg-white border border-amber-200/60 rounded-2xl p-8 md:p-10 shadow-sm text-stone-700 text-sm leading-relaxed tracking-wide text-justify space-y-6" 
         data-aos="fade-up" 
         data-aos-duration="1000" 
         data-aos-delay="200">
        
        <!-- Gambar Utama Sejarah (Ditambahkan secara kondisional) -->
        @if(!empty($sejarahData['sejarah_image']))
            <div class="w-full mb-8 overflow-hidden rounded-xl border border-amber-200/40 shadow-sm">
                <img src="{{ asset('storage/' . $sejarahData['sejarah_image']) }}" 
                     alt="{{ $sejarahData['sejarah_title'] ?? 'Gambar Sejarah' }}" 
                     class="w-full h-auto max-h-[450px] object-cover transition-transform duration-700 hover:scale-105">
            </div>
        @endif
        
        <!-- Paragraf Utama / Pembuka -->
        <p class="whitespace-pre-line first-letter:text-4xl first-letter:font-black first-letter:text-amber-700 first-letter:mr-2 first-letter:float-left">
            {{ $sejarahData['sejarah_body_1'] ?? 'Narasi teks dokumen sejarah utama belum diisi oleh pengelola admin museum. Silakan masuk ke panel dashboard admin untuk memperbarui isi catatan sejarah Kerajaan Talaga Manggung secara berkala.' }}
        </p>

        <!-- Paragraf Lanjutan -->
        @if(!empty($sejarahData['sejarah_body_2']))
            <p class="whitespace-pre-line pt-4 border-t border-stone-100">
                {{ $sejarahData['sejarah_body_2'] }}
            </p>
        @endif
    </div>

</main>





            <!-- Item Foto 3 -->
<x-site-footer />

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
