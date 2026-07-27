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

    <!-- 1. BILAH NAVIGASI (NAVBAR) MODULAR -->
    <x-site-navbar />

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

    <x-site-footer />
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
