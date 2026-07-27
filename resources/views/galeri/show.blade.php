<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Str::limit(strip_tags($galeri->deskripsi ?: 'Artefak bersejarah koleksi Museum Talaga Manggung Majalengka.'), 160) }}">
    <link rel="icon" type="image/png" href="{{ asset('images/webicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">
    <title>{{ $galeri->judul }} | Museum Talaga Manggung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-50 text-stone-900 antialiased font-sans min-h-screen flex flex-col">
    <!-- 1. BILAH NAVIGASI (NAVBAR) MODULAR -->
    <x-site-navbar />

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
