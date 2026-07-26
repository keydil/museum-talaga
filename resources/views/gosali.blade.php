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
            <!-- Perbaikan: Melengkapi tanda kutip pada href -->
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
            <a href="{{ route('berita.index') }}" class="hover:text-amber-700 transition">Berita</a>

            <!-- DROPDOWN 2: LIVING MUSEUM (DESKTOP HIGHLIGHT GOSALI) -->
            <div class="relative inline-block text-left">
                <!-- Judul utama 'Living Museum' ikut berwarna emas saat halaman Gosali aktif -->
                <button onclick="toggleDropdown(event, 'menuMuseum')" class="flex items-center {{ request()->routeIs('gosali') ? 'text-amber-600 font-semibold' : '' }} hover:text-amber-700 transition gap-1 focus:outline-none">
                    Living Museum <span class="text-[9px]">▼</span>
                </button>
                <div id="menuMuseum" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                    <a href="{{ route('walangsuji') }}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Walang Suji</a>
                    
                    <!-- HIGHLIGHT GOSALI DESKTOP: Perbaikan kelas ganda, diberi efek bg-amber-50 dan border pembatas kiri aktif -->
                    <a href="{{ route('gosali') }}" class="block px-4 py-2.5 text-xs {{ request()->routeIs('gosali') ? 'bg-amber-50 text-amber-600 font-bold border-l-4 border-amber-500' : 'text-stone-700' }} hover:bg-amber-50 hover:text-amber-800">Gosali</a>
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
                <!-- Perbaikan xmlns: URL resmi w3 org -->
                <svg xmlns="http://w3.org" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>

            <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
                <a href="{{ route('sejarah') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Sejarah</a>
                <a href="{{ route('visimisi') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Visi & Misi</a>
                <a href="{{ route('strukturorg') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Struktur Organisasi</a>
            </div>
        </details>

        <!-- KATALOG & BERITA -->
        <a href="{{ route('galeri') }}" wire:navigate class="block hover:text-amber-700 py-1 transition">Katalog</a>
        <a href="{{ route('berita.index') }}" wire:navigate class="block hover:text-amber-700 py-1 transition">Berita</a>

        <!-- DROPDOWN LIVING MUSEUM (SELULER HIGHLIGHT GOSALI) -->
        <!-- Otomatis menambahkan atribut 'open' jika pengguna berada di rute gosali agar menu melipat terbuka langsung -->
        <details class="group my-1">
            <summary class="flex items-center justify-between w-full text-sm font-medium hover:text-amber-700 cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-1.5">
                    Living Museum 
                </span>
                <svg xmlns="http://w3.org" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>

            <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
    <a href="{{ route('walangsuji') }}" wire:navigate 
       class="block text-stone-500 hover:text-amber-700 text-xs transition">
       Walang Suji
    </a>
    
    <!-- HIGHLIGHT GOSALI SELULER: Perhitungan presisi menggunakan -ml-[17px] pl-[15px] agar posisi teks sejajar sempurna dengan menu di atasnya saat aktif -->
    <a href="{{ route('gosali') }}" wire:navigate 
       class="block text-xs transition {{ request()->routeIs('gosali') ? 'text-amber-600 font-bold border-l-2 border-amber-500 -ml-[17px] pl-[15px]' : 'text-stone-500 hover:text-amber-700' }}">
       Gosali
    </a>
</div>

        </details>
    </div>
</header>

    <!-- 2. KONTEN UTAMA: GALERI (Gaya Google Images) -->
    <!-- PERBAIKAN: Mengubah background utama menjadi warna krem hangat (#fdfbf2) -->

<!-- Bagian Banner Latar Belakang Sepanjang Lebar Web Khusus Gosali -->
<div class="w-full mb-16 overflow-hidden aspect-[3/1] md:aspect-[21/9] lg:aspect-[3.5/1] bg-stone-900 shadow-sm">
    
    <!-- Gambar Latar Belakang Dinamis Khusus Halaman Gosali -->
    <!-- 🔴 Mengambil data khusus array key 'gosali' -->
    @if(isset($banners) && isset($banners['gosali']))
        <img src="{{ asset('storage/' . $banners['gosali']) }}" 
             alt="Header Banner Gosali" 
             class="w-full h-full object-cover">
    @else
        <!-- Gambar Default bertema tempaan logam, api, kerajinan senjata tradisional besi/baja jika admin belum unggah kustom -->
        <img src="https://unsplash.com" 
             alt="Default Banner Gosali" 
             class="w-full h-full object-cover opacity-80">
    @endif

</div>


<main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 py-8 bg-[#fdfbf2]">
    <div class="mb-8">
        <span class="text-xs font-bold tracking-widest text-amber-700 uppercase block mb-1">Living Museum</span>
        <h1 class="text-3xl font-serif font-bold text-stone-900 tracking-tight flex items-center gap-3">
            Gosali
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                🔴 Teater Digital
            </span>
        </h1>
        <p class="text-sm text-stone-600 mt-2 max-w-3xl">
            Saksikan rekonstruksi digital ritual, adat, dan warisan budaya adiluhung Kerajaan Talaga Manggung secara audiovisual interaktif.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-stone-950 rounded-2xl overflow-hidden shadow-xl aspect-video relative border border-amber-900/10">
                @if($videos->isNotEmpty())
                    @php
                        $firstVideo = $videos->first();
                        $videoSource = $firstVideo->video_file_path ? asset('storage/' . $firstVideo->video_file_path) : ($firstVideo->video_url ?? '');
                        $isYoutube = $videoSource && preg_match('#^(https?://)?(www\.)?(youtube\.com|youtu\.be)/#i', $videoSource);
                        $youtubeEmbedUrl = '';
                        if ($isYoutube) {
                            $youtubeEmbedUrl = preg_replace('#^(https?://)?(www\.)?(youtube\.com/watch\?v=|youtu\.be/)([\w-]+).*#i', 'https://www.youtube.com/embed/$4', $videoSource);
                        }
                        $posterSource = $firstVideo->thumbnail_path ? asset('storage/' . $firstVideo->thumbnail_path) : 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1200&q=80';
                    @endphp
                    @if($isYoutube)
                        <iframe id="mainMuseumPlayer" class="w-full h-full" src="{{ $youtubeEmbedUrl }}" title="{{ $firstVideo->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        <video id="mainMuseumPlayer" class="w-full h-full object-contain" controls poster="{{ $posterSource }}">
                            <source src="{{ $videoSource ?: 'https://www.w3schools.com/html/mov_bbb.mp4' }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutar video.
                        </video>
                    @endif
                @else
                    <div class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_top,_rgba(251,191,36,0.25),_transparent_60%)] p-6 text-center">
                        <div>
                            <div class="mb-3 text-4xl">🎞️</div>
                            <h2 class="text-lg font-semibold text-amber-100">Belum ada konten video</h2>
                            <p class="mt-2 text-sm text-stone-300">Konten akan muncul di sini setelah admin menambahkan video pertama.</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-xl p-6 border border-amber-200/60 shadow-sm">
                <div class="flex flex-wrap items-start justify-between gap-4 border-b border-stone-100 pb-4 mb-4">
                    <div>
                        <h2 id="currentVideoTitle" class="text-xl font-bold text-stone-900 font-serif">
                            {{ $videos->first()->title ?? 'Belum ada konten yang dipilih' }}
                        </h2>
                        <div class="flex items-center gap-4 text-xs text-stone-500 mt-1">
                            <span class="flex items-center gap-1">🕒 <span id="currentVideoDuration">{{ $videos->first()->duration ?? '00:00' }}</span></span>
                            <span>•</span>
                            <span class="flex items-center gap-1">👁️ 0 Dilihat</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-2">Sinopsis / Catatan Budaya</h3>
                    <p id="currentVideoDesc" class="text-sm text-stone-700 leading-relaxed">
                        {{ $videos->first()->description ?? 'Tambahkan sinopsis untuk menampilkan narasi yang muncul di halaman publik.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white rounded-xl border border-amber-200/60 shadow-sm overflow-hidden">
                <div class="bg-stone-900 text-amber-100 p-4 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-sm tracking-wide">Daftar Babak Dokumenter</h3>
                        <p class="text-xs text-stone-400">Koleksi Living Museum</p>
                    </div>
                    <span class="text-xs bg-amber-800/80 px-2.5 py-1 rounded font-mono">{{ $videos->count() }} Episode</span>
                </div>

                <div class="divide-y divide-stone-100 max-h-[480px] overflow-y-auto">
                    @forelse($videos as $video)
                        @php
                            $videoSource = $video->video_file_path ? asset('storage/' . $video->video_file_path) : ($video->video_url ?? '');
                            $posterSource = $video->thumbnail_path ? asset('storage/' . $video->thumbnail_path) : '';
                            $isYoutube = $videoSource && preg_match('#^(https?://)?(www\.)?(youtube\.com|youtu\.be)/#i', $videoSource);
                            $youtubeEmbedUrl = '';
                            if ($isYoutube) {
                                $youtubeEmbedUrl = preg_replace('#^(https?://)?(www\.)?(youtube\.com/watch\?v=|youtu\.be/)([\w-]+).*#i', 'https://www.youtube.com/embed/$4', $videoSource);
                            }
                        @endphp
                        <div onclick="playVideo(this, '{{ $videoSource }}', '{{ addslashes($video->title) }}', '{{ addslashes($video->description) }}', '{{ $video->duration }}', '{{ $posterSource }}', '{{ $youtubeEmbedUrl }}')"
                             class="w-full p-3.5 flex gap-3 cursor-pointer hover:bg-amber-50/50 transition items-start border-l-4 border-transparent group {{ $loop->first ? 'bg-amber-50/70 border-amber-600' : '' }}">
                            <div class="w-24 aspect-video bg-stone-800 rounded relative shrink-0 overflow-hidden border border-amber-200">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                    <span class="text-amber-400 text-xs">{{ $loop->first ? '▶️ Aktif' : '▶️' }}</span>
                                </div>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-xs {{ $loop->first ? 'font-bold text-amber-900' : 'font-semibold text-stone-800' }} line-clamp-2">{{ $video->title }}</h4>
                                <span class="text-[10px] {{ $loop->first ? 'text-amber-700' : 'text-stone-500' }} mt-1 block font-medium">{{ $video->duration }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-sm text-stone-500">
                            <div class="mb-2 text-2xl">📭</div>
                            <p class="font-medium text-stone-700">Belum ada data video untuk ditampilkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="p-4 bg-amber-100/40 rounded-xl border border-amber-200 text-xs text-amber-900">
                <p class="font-bold mb-1">💡 Info Tambahan:</p>
                <p class="text-stone-700 leading-relaxed">
                    Setiap klip video di atas menyajikan rekonstruksi visual berbasis arsip sejarah resmi Museum Talaga Manggung.
                </p>
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


// ==========================================
// TAMBAHAN SCRIPT UNTUK PLAYLIST WALANG SUJI
// ==========================================
function playVideo(element, videoSrc, title, description, duration, posterSrc, youtubeEmbedUrl) {
    const player = document.getElementById('mainMuseumPlayer');
    const titleElem = document.getElementById('currentVideoTitle');
    const descElem = document.getElementById('currentVideoDesc');
    const durationElem = document.getElementById('currentVideoDuration');

    if (player) {
        if (youtubeEmbedUrl) {
            player.outerHTML = '<iframe id="mainMuseumPlayer" class="w-full h-full" src="' + youtubeEmbedUrl + '" title="' + title + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        } else {
            player.src = videoSrc || '';
            player.poster = posterSrc || 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1200&q=80';
            player.load();
            if (videoSrc) {
                player.play().catch(() => {});
            }
        }
    }

    if (titleElem) titleElem.innerText = title || 'Judul belum tersedia';
    if (descElem) descElem.innerText = description || 'Deskripsi belum tersedia';
    if (durationElem) durationElem.innerText = duration || '00:00';

    const allPlaylistItems = element.parentElement.children;
    Array.from(allPlaylistItems).forEach((item) => {
        item.classList.remove('bg-amber-50/70', 'border-amber-600');
        item.classList.add('border-transparent');

        const itemTitle = item.querySelector('h4');
        if (itemTitle) {
            itemTitle.classList.remove('font-bold', 'text-amber-900');
            itemTitle.classList.add('font-semibold', 'text-stone-800');
        }
    });

    element.classList.add('bg-amber-50/70', 'border-amber-600');
    element.classList.remove('border-transparent');

    const activeTitle = element.querySelector('h4');
    if (activeTitle) {
        activeTitle.classList.remove('font-semibold', 'text-stone-800');
        activeTitle.classList.add('font-bold', 'text-amber-900');
    }
}

</script>
