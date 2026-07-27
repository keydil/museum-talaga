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

            <!-- DROPDOWN 1: PROFIL (DESKTOP HIGHLIGHT STRUKTUR ORGANISASI) -->
            <div class="relative inline-block text-left">
                <!-- Tombol utama 'Profil' ikut berwarna amber saat sub-menu Struktur Organisasi aktif -->
                <button onclick="toggleDropdown(event, 'menuProfil')" class="flex items-center {{ request()->routeIs('strukturorg') ? 'text-amber-600 font-semibold' : '' }} hover:text-amber-700 transition gap-1 focus:outline-none">
                    Profil <span class="text-[9px]">▼</span>
                </button>
                <div id="menuProfil" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                    <a href="{{ route('sejarah')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Sejarah</a>
                    <a href="{{ route('visimisi')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Visi & Misi</a>
                    
                    <!-- HIGHLIGHT STRUKTUR ORGANISASI DESKTOP -->
                    <a href="{{ route('strukturorg')}}" class="block px-4 py-2.5 text-xs {{ request()->routeIs('strukturorg') ? 'bg-amber-50 text-amber-600 font-bold border-l-4 border-amber-500' : 'text-stone-700' }} hover:bg-amber-50 hover:text-amber-800">Struktur Organisasi</a>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>

            <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
    <a href="{{ route('sejarah') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Sejarah</a>
    <a href="{{ route('visimisi') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Visi & Misi</a>
    
    <!-- STRUKTUR ORGANISASI AKTIF -->
    <a href="{{ route('strukturorg') }}" wire:navigate 
       class="block text-xs transition text-amber-600 font-bold border-l-2 border-amber-500 -ml-[17px] pl-[15px]">
       Struktur Organisasi
    </a>
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


 <!-- 2. KONTEN UTAMA -->

<div class="w-full mb-16 overflow-hidden aspect-[3/1] md:aspect-[21/9] lg:aspect-[3.5/1] bg-stone-900 shadow-sm relative">
    <!-- Gambar Latar Belakang Banner Halaman -->
    @if(isset($banners) && isset($banners['strukturorg']))
        <img src="{{ asset('storage/' . $banners['strukturorg']) }}" 
             alt="Header Banner Struktur Organisasi" 
             class="w-full h-full object-cover">
    @else
        <!-- Perbaikan: URL Gambar Default spesifik agar tidak terblokir CORB browser -->
        <img src="https://unsplash.com" 
             alt="Default Banner Struktur Organisasi" 
             class="w-full h-full object-cover opacity-50">
    @endif
</div>

<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12 bg-[#fdfbf2]">
    <div class="mx-auto max-w-6xl space-y-6">
        
        <!-- Header Judul -->
        {{-- <div class="rounded-3xl border border-amber-200 bg-white p-8 shadow-sm">
            <p class="mb-3 inline-flex rounded-full bg-amber-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-amber-700">
                Struktur Organisasi
            </p>
            <h1 class="text-3xl font-black tracking-tight text-stone-900">Susunan jabatan dan staf museum</h1>
            <p class="mt-3 max-w-3xl text-sm leading-6 text-stone-600">
                Halaman ini menampilkan bagan kepengurusan resmi museum serta penjelasan tupoksi masing-masing divisi.
            </p>
        </div> --}}

        <!-- Bagian 1: Tampilan Gambar Bagan Struktur Organisasi -->
        <div class="rounded-3xl border border-amber-200 bg-white p-6 shadow-sm flex flex-col items-center">
            <!-- PERBAIKAN: Mengubah $struktur->image_path menjadi $struktur->image sesuai kolom DB -->
            @if(isset($struktur) && isset($struktur->image))
                <div class="w-full bg-stone-50 rounded-2xl p-4 border border-stone-100 flex justify-center overflow-hidden">
                    <img src="{{ asset('storage/' . $struktur->image) }}" 
                         alt="Bagan Struktur Organisasi Museum" 
                         onclick="openImageModal(this.src)"
                         class="max-w-full h-auto rounded-xl shadow-sm hover:scale-[1.01] transition-transform duration-300 cursor-zoom-in">
                </div>
                <p class="text-[11px] text-stone-400 mt-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                    </svg>
                    <span>Klik gambar untuk memperbesar resolusi bagan.</span>
                </p>
            @else
                <div class="w-full rounded-2xl border border-dashed border-stone-300 bg-stone-50 p-12 text-center text-sm text-stone-500">
                    <svg class="mx-auto h-10 w-10 text-stone-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H2.25A1.5 1.5 0 00.75 6v12.75a1.5 1.5 0 001.5 1.5z" />
                    </svg>
                    Bagan gambar struktur organisasi belum diunggah oleh admin.
                </div>
            @endif
        </div>

        <!-- Bagian 2: Teks Deskripsi Statis dengan Animasi -->
        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="space-y-8">
            
            <!-- Pengantar Struktur -->
            <div class="rounded-2xl border border-amber-200 bg-gradient-to-br from-white to-amber-50/30 p-8 shadow-sm">
                <h2 class="text-2xl font-black text-amber-900 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Struktur Organisasi Museum
                </h2>
                <p class="text-stone-700 leading-relaxed text-base">
                    Museum Talaga Manggung memiliki struktur organisasi yang dirancang untuk mendukung visi dan misi institusi dalam pelestarian dan edukasi budaya. Setiap divisi memiliki peran strategis dalam menjalankan operasional museum secara efektif dan profesional.
                </p>
            </div>

            <!-- Divider dengan Animasi -->
            <div class="flex items-center gap-4">
                <div class="flex-grow h-0.5 bg-gradient-to-r from-amber-600 to-transparent rounded-full"></div>
                <span class="text-amber-700 font-semibold text-sm">✦</span>
                <div class="flex-grow h-0.5 bg-gradient-to-l from-amber-600 to-transparent rounded-full"></div>
            </div>

            <!-- Grid Divisi Organisasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Divisi 1 -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="rounded-xl border border-amber-200 bg-white p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="text-2xl">🎯</div>
                        <h3 class="font-bold text-stone-900">Divisi Pameran & Koleksi</h3>
                    </div>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Bertanggung jawab dalam pengelolaan koleksi museum, kurasi pameran, dan presentasi artefak bersejarah kepada publik dengan standar konservasi internasional.
                    </p>
                </div>

                <!-- Divisi 2 -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500" class="rounded-xl border border-amber-200 bg-white p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="text-2xl">📚</div>
                        <h3 class="font-bold text-stone-900">Divisi Riset & Dokumentasi</h3>
                    </div>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Melaksanakan penelitian mendalam terhadap cagar budaya, pengarsipan digital, dan pendokumentasian komprehensif untuk kelestarian pengetahuan budaya.
                    </p>
                </div>

                <!-- Divisi 3 -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600" class="rounded-xl border border-amber-200 bg-white p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="text-2xl">🎓</div>
                        <h3 class="font-bold text-stone-900">Divisi Edukasi & Komunitas</h3>
                    </div>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Menyelenggarakan program edukasi, workshop, seminar, dan kegiatan komunitas untuk meningkatkan literasi budaya masyarakat luas.
                    </p>
                </div>

                <!-- Divisi 4 -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700" class="rounded-xl border border-amber-200 bg-white p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="text-2xl">🛠️</div>
                        <h3 class="font-bold text-stone-900">Divisi Operasional & Teknis</h3>
                    </div>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Mengelola infrastruktur museum, sistem keamanan, teknologi, dan logistik untuk menjamin kelancaran operasional institusi.
                    </p>
                </div>
            </div>

            <!-- Divider kedua -->
            <div class="flex items-center gap-4">
                <div class="flex-grow h-0.5 bg-gradient-to-r from-amber-600 to-transparent rounded-full"></div>
                <span class="text-amber-700 font-semibold text-sm">✦</span>
                <div class="flex-grow h-0.5 bg-gradient-to-l from-amber-600 to-transparent rounded-full"></div>
            </div>

            <!-- Prinsip Kerja -->
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800" class="rounded-2xl border-2 border-stone-300 bg-gradient-to-br from-stone-50 to-transparent p-8">
                <h3 class="text-xl font-black text-stone-900 mb-5 flex items-center gap-2">
                    <svg class="w-6 h-6 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Prinsip Kerja Tim
                </h3>
                <ul class="space-y-3 text-stone-600 text-sm">
                    <li class="flex gap-3">
                        <span class="text-amber-700 font-bold">•</span>
                        <span><strong>Kolaboratif:</strong> Setiap divisi bekerja bersama dengan tujuan bersama dalam melestarikan warisan budaya.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-amber-700 font-bold">•</span>
                        <span><strong>Profesional:</strong> Menjalankan tugas dengan standar internasional dan etika kerja yang tinggi.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-amber-700 font-bold">•</span>
                        <span><strong>Inovatif:</strong> Terus mengembangkan metode baru dalam konservasi, edukasi, dan pengelolaan koleksi.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-amber-700 font-bold">•</span>
                        <span><strong>Transparan:</strong> Terbuka dalam komunikasi dan akuntabilitas terhadap stakeholder dan masyarakat.</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</main>

<!-- Wajib Ditambahkan: Modal Pop-up Ringan untuk Zoom Gambar -->
<div id="imageZoomModal" class="fixed inset-0 z-50 hidden bg-stone-950/90 flex items-center justify-center p-4 backdrop-blur-sm" onclick="closeImageModal()">
    <button class="absolute top-6 right-6 text-white bg-white/10 p-2 rounded-full hover:bg-white/20 transition duration-150">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img id="modalTargetImage" src="" alt="Zoomed Bagan" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl" onclick="event.stopPropagation()">
</div>

<x-site-footer/>
            <!-- Item Foto 3 -->

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

function openImageModal(src) {
        document.getElementById('modalTargetImage').src = src;
        document.getElementById('imageZoomModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Kunci scroll halaman belakang
    }
    function closeImageModal() {
        document.getElementById('imageZoomModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Aktifkan kembali scroll
    }
</script>
