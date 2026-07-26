<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/webicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">
    <title>{{ $galeri->judul }} - Profil Museum & Arsip Sejarah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-50 text-stone-900 antialiased font-sans min-h-screen flex flex-col">
   <header class="border-b border-amber-200 bg-white/80 backdrop-blur sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between gap-4">

            <!-- SISI KIRI: Logo Web -->
            <div class="flex items-center font-sans tracking-wide shrink-0">
                <a href="{{ url('/') }}" class="block hover:opacity-90 transition">
                    <img src="{{ Vite::asset('resources/images/image_ee43ecbd.svg') }}"
                         alt="Museum Talaga Manggung"
                         class="h-auto max-h-12 w-auto object-contain" />
                </a>
            </div>

            <!-- SISI KANAN: Menu Desktop -->
            <nav class="hidden md:flex items-center space-x-6 text-xs md:text-sm font-medium text-stone-600 whitespace-nowrap ml-auto">
                <a href="{{ url('/') }}" class="hover:text-amber-700 transition">Beranda</a>

                <!-- Dropdown Profil (Sudah Interaktif Klik) -->
                <div class="relative inline-block text-left">
                    <button onclick="toggleDropdown(event, 'menuProfil')" class="flex items-center hover:text-amber-700 transition gap-1 focus:outline-none">
                        Profil <span class="text-[9px]">▼</span>
                    </button>
                    <div id="menuProfil" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                        <a href="{{ route('sejarah') }}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Sejarah</a>
                        <a href="{{ route('visimisi') }}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Visi & Misi</a>
                        <a href="{{ route('strukturorg') }}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800">Struktur Organisasi</a>
                    </div>
                </div>

                <!-- MENU AKTIF: Berita berwarna amber -->
                <a href="{{ route('galeri') }}" class="text-amber-500 class="hover:text-amber-700 transition">Galeri</a>
                <a href="{{ route('berita.index') }}" hover:text-amber-700 transition">Berita</a>

                <!-- Dropdown Living Museum (Sudah Interaktif Klik) -->
                <div class="relative inline-block text-left">
                    <button onclick="toggleDropdown(event, 'menuMuseum')" class="flex items-center hover:text-amber-700 transition gap-1 focus:outline-none">
                        Living Museum <span class="text-[9px]">▼</span>
                    </button>
                    <div id="menuMuseum" class="absolute left-0 mt-2 w-44 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                        <a href="{{route('walangsuji')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Walang Suji</a>
                        <a href="{{route('gosali')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800">Gosali</a>
                    </div>
                </div>
            </nav>

            <!-- Tombol Menu Hamburger untuk HP -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-button" type="button" class="text-stone-600 hover:text-amber-700 focus:outline-none p-2 rounded-md hover:bg-amber-50 transition" aria-label="Toggle menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- PANEL MENU SELULER -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-amber-100 bg-white px-6 py-4 space-y-3 text-sm font-medium text-stone-600 shadow-inner">
            <a href="{{ url('/') }}" class="block hover:text-amber-700 py-1 transition">Beranda</a>
            <div class="border-l-2 border-amber-200 pl-3 space-y-2 my-1">
                <span class="text-xs text-stone-400 uppercase tracking-wider block">Profil</span>
                <a href="{{ route('sejarah') }}" class="block hover:text-amber-700 text-xs transition">Sejarah</a>
                <a href="{{ route('visimisi') }}" class="block hover:text-amber-700 text-xs transition">Visi & Misi</a>
                <a href="{{ route('strukturorg') }}" class="block hover:text-amber-700 text-xs transition">Struktur Organisasi</a>
            </div>
            <a href="{{ route('galeri') }}" class="block text-amber-500 class="block hover:text-amber-700 py-1 transition">Galeri</a>
            <a href="{{ route('berita.index') }}" hover:text-amber-700 py-1 transition">Berita</a>
            <div class="border-l-2 border-amber-200 pl-3 space-y-2 my-1">
                <span class="text-xs text-stone-400 uppercase tracking-wider block">Living Museum</span>
                <a href="{{ route('walangsuji')}}" class="block hover:text-amber-700 text-xs transition">Walang Suji</a>
                <a href="{{ route('gosali')}}" class="block hover:text-amber-700 text-xs transition">Gosali</a>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12">
        <div class="mb-8">
            <a href="{{ route('galeri') }}" class="inline-flex items-center text-sm font-medium text-amber-700 hover:text-amber-800">
                ← Kembali ke Galeri
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_0.8fr] gap-8 items-start">
            <div class="bg-white rounded-3xl shadow-sm border border-stone-200/70 overflow-hidden">
                <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" class="w-full h-[420px] object-cover">
            </div>

            <div class="space-y-6">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-amber-600">{{ $galeri->kategori }}</p>
                    <h1 class="text-3xl md:text-4xl font-black text-stone-900 mt-2 leading-tight">{{ $galeri->judul }}</h1>
                </div>

                <div class="bg-white rounded-2xl border border-stone-200/70 p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-stone-800">Deskripsi</h2>
                    <p class="mt-3 text-sm leading-7 text-stone-600">
                        {{ $galeri->deskripsi ?: 'Belum ada deskripsi untuk koleksi ini.' }}
                    </p>
                </div>

                @if($galeri->link_3d)
                    <a href="{{ $galeri->link_3d }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center w-full bg-amber-700 hover:bg-amber-800 text-white font-semibold px-4 py-3 rounded-2xl transition">
                        Lihat Model 3D
                    </a>
                @endif
            </div>
        </div>

        @if($related->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-stone-800 mb-6">Galeri Terkait</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($related as $item)
                        <a href="{{ route('galeri.show', $item) }}" class="group bg-white rounded-2xl border border-stone-200/70 overflow-hidden shadow-sm hover:shadow-md transition">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-full h-40 object-cover group-hover:scale-105 transition duration-300">
                            <div class="p-4">
                                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-amber-600">{{ $item->kategori }}</p>
                                <h3 class="mt-1 text-sm font-semibold text-stone-800">{{ $item->judul }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    <footer class="bg-[#1c1917] text-stone-400 text-xs py-12 border-t border-stone-800 font-sans mt-auto w-full">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-stone-500">&copy; 2026 Museum Talaga Manggung</p>
        </div>
    </footer>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        menuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });
    });

    function toggleDropdown(event, menuId) {
        event.stopPropagation();

        const targetMenu = document.getElementById(menuId);

        // Ambil semua elemen dropdown yang ada di halaman
        const allMenus = document.querySelectorAll('.dropdown-list');

        // Tutup semua dropdown lain terlebih dahulu
        allMenus.forEach(menu => {
            if (menu !== targetMenu) {
                menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
            }
        });

        // Toggle dropdown yang sedang diklik
        targetMenu.classList.toggle('opacity-0');
        targetMenu.classList.toggle('invisible');
        targetMenu.classList.toggle('-translate-y-2');

        targetMenu.classList.toggle('opacity-100');
        targetMenu.classList.toggle('visible');
        targetMenu.classList.toggle('translate-y-0');
    }

    // Menutup semua dropdown jika klik di luar area menu
    window.addEventListener('click', function() {
        const allMenus = document.querySelectorAll('.dropdown-list');

        allMenus.forEach(menu => {
            menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
            menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
        });
    });
</script>
</html>
