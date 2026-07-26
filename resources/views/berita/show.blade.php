<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/webicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">
    <title>{{ $berita->judul }} - Profil Museum & Arsip Sejarah</title>
    <!-- Menghubungkan aset CSS & JS lokal Laravel (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Menggunakan latar belakang krem muda hangat -->
<body class="bg-amber-50 text-stone-900 antialiased font-sans min-h-screen flex flex-col">

    <!-- 1. BILAH NAVIGASI (NAVBAR) -->
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
                <a href="{{ route('galeri') }}" class="hover:text-amber-700 transition">Galeri</a>
                <a href="{{ route('berita.index') }}" class="text-amber-500 hover:text-amber-700 transition">Berita</a>

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
            <a href="{{ route('galeri') }}" class="block hover:text-amber-700 py-1 transition">Galeri</a>
            <a href="{{ route('berita.index') }}" class="block text-amber-500 hover:text-amber-700 py-1 transition">Berita</a>
            <div class="border-l-2 border-amber-200 pl-3 space-y-2 my-1">
                <span class="text-xs text-stone-400 uppercase tracking-wider block">Living Museum</span>
                <a href="{{ route('walangsuji')}}" class="block hover:text-amber-700 text-xs transition">Walang Suji</a>
                <a href="{{ route('gosali')}}" class="block hover:text-amber-700 text-xs transition">Gosali</a>
            </div>
        </div>
    </header>

    <!-- 2. KONTEN UTAMA HALAMAN DETAIL BERITA -->
    <main class="flex-grow max-w-4xl w-full mx-auto px-6 py-12">
        
        <!-- Breadcrumb Navigasi -->
        <div class="mb-8 flex items-center space-x-2 text-xs text-stone-500 font-medium">
            <a href="{{ url('/') }}" class="hover:text-amber-700 transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('berita.index') }}" class="hover:text-amber-700 transition">Berita</a>
            <span>/</span>
            <span class="text-stone-700">{{ $berita->judul }}</span>
        </div>

        <!-- Header Artikel -->
        <article class="mb-12">
            <!-- Badge Kategori -->
            <div class="mb-4">
                <span class="bg-amber-100 text-amber-800 text-[11px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full inline-block">
                    {{ $berita->kategori }}
                </span>
            </div>

            <!-- Judul Artikel -->
            <h1 class="text-4xl md:text-5xl font-black text-amber-700 tracking-tight leading-tight mb-4">
                {{ $berita->judul }}
            </h1>

            <!-- Meta Informasi -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-amber-200">
                <div class="flex items-center space-x-4 text-sm text-stone-600">
                    <time datetime="{{ $berita->tanggal_publikasi }}">
                        📅 {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('l, d F Y') }}
                    </time>
                    <span class="text-stone-400">•</span>
                    <span>✍️ Oleh Administrator</span>
                </div>
            </div>

            <!-- Gambar/Foto Berita -->
            @if($berita->foto)
                <div class="my-12 rounded-xl overflow-hidden shadow-md border border-amber-200/50">
                    <img src="{{ asset('storage/' . $berita->foto) }}" 
                         alt="{{ $berita->judul }}" 
                         class="w-full h-auto object-cover max-h-96">
                </div>
            @endif

            <!-- Ringkasan Singkat -->
            @if($berita->ringkasan)
                <div class="bg-amber-50/60 border border-amber-200/70 rounded-xl p-6 mb-8 font-medium text-stone-700 leading-relaxed italic">
                    {{ $berita->ringkasan }}
                </div>
            @endif

            <!-- Konten Lengkap -->
            <div class="prose prose-sm md:prose-base max-w-none text-stone-700 leading-relaxed space-y-6">
                {!! nl2br(e($berita->konten_lengkap)) !!}
            </div>

            <!-- Footer Artikel -->
            <div class="mt-12 pt-8 border-t border-stone-200 flex items-center justify-between">
                <div class="text-xs text-stone-500">
                    Dipublikasikan: {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y \p\u\k\u\l H:i') }}
                </div>
                <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm px-4 py-2 rounded-lg transition">
                    ← Kembali ke Berita
                </a>
            </div>
        </article>

        <!-- Artikel Terkait (Opsional) -->
        @if($beritaTerkait->count() > 0)
            <div class="mt-16 pt-12 border-t border-amber-200">
                <h3 class="text-2xl font-bold text-amber-700 mb-8">Berita Terkait</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($beritaTerkait as $item)
                        <article class="bg-white border border-amber-100 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                            <div class="h-40 bg-stone-200 relative">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" 
                                         alt="{{ $item->judul }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center text-stone-400 font-medium text-xs">Tidak Ada Foto</div>
                                @endif
                            </div>
                            <div class="p-4">
                                <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider block mb-2">
                                    {{ $item->kategori }}
                                </span>
                                <h4 class="font-bold text-stone-800 text-sm mb-2 line-clamp-2 hover:text-amber-700">
                                    <a href="{{ route('berita.show', $item->id) }}">{{ $item->judul }}</a>
                                </h4>
                                <p class="text-xs text-stone-600 line-clamp-2 mb-3">
                                    {{ $item->ringkasan }}
                                </p>
                                <div class="flex items-center justify-between text-[10px] text-stone-500">
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_publikasi)->translatedFormat('d F Y') }}</span>
                                    <a href="{{ route('berita.show', $item->id) }}" class="text-amber-600 hover:text-amber-800 font-semibold">
                                        Baca →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    <footer class="bg-[#1c1917] text-stone-400 text-xs py-12 border-t border-stone-800 font-sans mt-auto w-full overflow-hidden">
        <!-- Membungkus isi dengan wadah maksimal max-w-7xl dan menambahkan padding x-6 yang aman -->
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">

            <!-- KOLOM 1: Informasi Instansi & Hak Cipta -->
            <div class="flex flex-col justify-between space-y-2">
                <div>
                    <h3 class="text-white font-serif font-black text-sm tracking-tight mb-2">Museum Talaga Manggung</h3>
                    <p class="text-stone-500 leading-relaxed text-[11px]">Wadah pelestarian benda pusaka, manuskrip kuno, dan rekam jejak sejarah peradaban institusi.</p>
                </div>
                <p class="text-stone-600 pt-4 md:pt-0">&copy; 2026 Hak Cipta Dilindungi.</p>
            </div>

            <!-- KOLOM 2: Navigasi Tautan Cepat -->
            <div class="flex flex-col space-y-2.5">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1">Akses Pintasan</h4>
                <div class="grid grid-cols-2 gap-x-4 gap-y-2 max-w-xs mx-auto md:mx-0 text-left">
                    {{-- Links --}}
                </div>
            </div>

            <!-- KOLOM 3: Legalitas & Dokumen Kebijakan -->
            <div class="flex flex-col space-y-2.5">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1">Informasi Hukum</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan Penggunaan</a></li>
                    <li><a href="#" class="hover:text-white transition">Bantuan & Kontak Resmi</a></li>
                </ul>
            </div>

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
