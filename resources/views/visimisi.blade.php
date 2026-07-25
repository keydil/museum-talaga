<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - Museum & Arsip Sejarah</title>
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
                <button onclick="toggleDropdown(event, 'menuProfil')" class="flex items-center {{ request()->routeIs('visimisi') ? 'text-amber-600 font-semibold' : '' }} hover:text-amber-700 transition gap-1 focus:outline-none">
                    Profil <span class="text-[9px]">▼</span>
                </button>
                <div id="menuProfil" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                    <a href="{{ route('sejarah')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Sejarah</a>
                    <a href="{{ route('visimisi')}}" class="block px-4 py-2.5 text-xs {{ request()->routeIs('visimisi') ? 'bg-amber-50 text-amber-600 font-bold border-l-4 border-amber-500' : 'text-stone-700' }} hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Visi & Misi</a>
                    
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
            <summary class="flex items-center justify-between w-full text-sm font-medium {{ request()->routeIs('strukturorg') ? 'text-amber-600' : 'text-stone-600' }} hover:text-amber-700 cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-1.5">
                    Profil 
                </span>
                <svg xmlns="http://w3.org" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>

            <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
    <a href="{{ route('sejarah') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Sejarah</a>
    
    <!-- VISI & MISI AKTIF -->
    <a href="{{ route('visimisi') }}" wire:navigate 
       class="block text-xs transition text-amber-600 font-bold border-l-2 border-amber-500 -ml-[17px] pl-[15px]">
       Visi & Misi
    </a>
    
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

    <!-- 2. KONTEN UTAMA: GALERI (Gaya Google Images) -->
    <!-- PERBAIKAN: Mengubah background utama menjadi warna krem hangat (#fdfbf2) -->
    <div class="w-full mb-16 overflow-hidden aspect-[3/1] md:aspect-[21/9] lg:aspect-[3.5/1] bg-stone-900 shadow-sm">
    
    <!-- Gambar Latar Belakang Dinamis Khusus Halaman Visi Misi -->
    <!-- 🔴 Mengambil data khusus array key 'visimisi' -->
    @if(isset($banners) && isset($banners['visimisi']))
        <img src="{{ asset('storage/' . $banners['visimisi']) }}" 
             alt="Header Banner Visi Misi" 
             class="w-full h-full object-cover">
    @else
        <!-- Gambar Default bertema arsitektur/gedung museum/ruang formal jika admin belum unggah gambar kustom -->
        <img src="https://unsplash.com" 
             alt="Default Banner Visi Misi" 
             class="w-full h-full object-cover opacity-80">
    @endif

</div>
<main class="flex-grow max-w-4xl w-full mx-auto px-6 py-12 bg-[#fdfbf2] font-sans">
    
    <!-- Bagian Judul dan Abstrak Visi Misi -->
    {{-- <div class="text-center mb-12 flex flex-col items-center" data-aos="fade-down" data-aos-duration="800">
        <h1 class="text-3xl md:text-5xl font-black text-amber-800 tracking-tight leading-tight">
            {{ $visimisiData['visimisi_title'] ?? 'Visi & Misi Institut' }}
        </h1>
        <p class="mt-4 text-stone-600 text-sm md:text-base leading-relaxed max-w-2xl italic">
            "{{ $visimisiData['visimisi_subtitle'] ?? 'Panduan strategis dalam melestarikan warisan leluhur dan mengedukasi generasi masa depan.' }}"
        </p>
        <div class="h-0.5 w-16 bg-amber-600 rounded-full mt-6"></div>
    </div> --}}

    <!-- Wadah Konten Utama dengan Animasi -->
    <div class="space-y-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        
        <!-- Grid Pemisah Visi & Misi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
            
            <!-- Kotak Visi dengan Animasi -->
            <div data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300" class="bg-gradient-to-br from-white to-amber-50/30 border-2 border-amber-300 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-amber-600 to-amber-700 text-white font-black text-lg">V</div>
                    <h2 class="text-2xl font-black text-amber-900 tracking-tight">Visi</h2>
                </div>
                
                <div class="space-y-4">
                    <p class="text-stone-700 text-base leading-relaxed font-medium">
                        Pelestarian aset budaya baik itu benda atau tak benda yang bernilai sejarah, sehingga dikemudian hari masih bisa dinikmati dan diketahui keberadaannya oleh generasi yang akan datang.
                    </p>
                    
                    <!-- Dekoratif visual -->
                    <div class="pt-4 mt-4 border-t border-amber-200">
                        <div class="flex gap-2">
                            <div class="w-1 h-8 bg-gradient-to-b from-amber-600 to-transparent rounded-full"></div>
                            <p class="text-xs text-amber-700 italic font-semibold leading-relaxed">
                                Menjaga warisan masa lalu untuk pencerahan masa depan
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kotak Misi dengan Animasi -->
            <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400" class="bg-gradient-to-br from-white to-stone-50/30 border-2 border-stone-300 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-stone-600 to-stone-700 text-white font-black text-lg">M</div>
                    <h2 class="text-2xl font-black text-stone-900 tracking-tight">Misi</h2>
                </div>
                
                <ol class="space-y-4 text-stone-700 text-base leading-relaxed">
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 flex items-center justify-center w-6 h-6 rounded-full bg-amber-100 text-amber-800 font-bold text-sm">1</span>
                        <span>Mengoptimalkan pemanfaatan potensi sumber daya dan wawasan kebudayaan</span>
                    </li>
                    
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 flex items-center justify-center w-6 h-6 rounded-full bg-amber-100 text-amber-800 font-bold text-sm">2</span>
                        <span>Meningkatkan manajemen Museum Talaga Manggung sebagai sarana edukasi sejarah dan budaya serta ruang pamer artefak sejarah</span>
                    </li>
                    
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 flex items-center justify-center w-6 h-6 rounded-full bg-amber-100 text-amber-800 font-bold text-sm">3</span>
                        <span>Pendataan dan konservasi cagar budaya</span>
                    </li>
                    
                    <li class="flex gap-3">
                        <span class="flex-shrink-0 flex items-center justify-center w-6 h-6 rounded-full bg-amber-100 text-amber-800 font-bold text-sm">4</span>
                        <span>Penguatan kelembagaan dan masyarakat adat</span>
                    </li>
                </ol>
            </div>

        </div>

        <!-- Bagian Inspirasi dengan Animasi Tambahan -->
        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500" class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl border border-amber-200 p-6 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="text-3xl mb-3">📚</div>
                <h3 class="font-bold text-stone-900 mb-2">Edukasi Berkelanjutan</h3>
                <p class="text-xs text-stone-600 leading-relaxed">Kami berkomitmen menjadi pusat pembelajaran bagi semua kalangan masyarakat tentang kekayaan budaya lokal.</p>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white rounded-xl border border-amber-200 p-6 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="text-3xl mb-3">🛡️</div>
                <h3 class="font-bold text-stone-900 mb-2">Konservasi Aktif</h3>
                <p class="text-xs text-stone-600 leading-relaxed">Perlindungan dan perawatan sistematis terhadap setiap aset budaya dengan standar internasional.</p>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-white rounded-xl border border-amber-200 p-6 text-center hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="text-3xl mb-3">🤝</div>
                <h3 class="font-bold text-stone-900 mb-2">Pemberdayaan Komunitas</h3>
                <p class="text-xs text-stone-600 leading-relaxed">Kolaborasi dengan masyarakat adat dan stakeholder dalam melestarikan warisan budaya bersama.</p>
            </div>
        </div>
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
