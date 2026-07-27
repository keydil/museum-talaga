<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Katalog arsip visual, foto dokumentasi pusaka, dan objek 3D interaktif koleksi bersejarah Museum Talaga Manggung.">
    <link rel="icon" type="image/png" href="{{ asset('images/webicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">
    <title>Katalog Artefak & Visual 3D | Museum Talaga Manggung</title>
    <!-- Menghubungkan aset CSS & JS lokal Laravel (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Menggunakan latar belakang krem muda hangat -->
<body class="bg-amber-50 text-stone-900 antialiased font-sans min-h-screen flex flex-col">

    <!-- 1. BILAH NAVIGASI (NAVBAR) MODULAR -->
    <x-site-navbar />

    <!-- 2. KONTEN UTAMA: GALERI (Gaya Google Images) -->
    <!-- Bagian Banner Latar Belakang Header Saja -->
<!-- Bagian Banner Latar Belakang Header Sepanjang Lebar Web -->
<div class="w-full mb-16 overflow-hidden aspect-[3/1] md:aspect-[21/9] lg:aspect-[3.5/1] bg-stone-900 shadow-sm">
    
    <!-- Gambar Latar Belakang Dinamis Khusus Halaman Galeri -->
    <!-- KOREKSI: Menggunakan variabel array global $banners dengan indeks 'galeri' -->
    @if(isset($banners) && isset($banners['galeri']))
        <img src="{{ asset('storage/' . $banners['galeri']) }}" 
             alt="Header Banner Galeri" 
             class="w-full h-full object-cover">
    @else
        <!-- KOREKSI: Menggunakan berkas gambar asli (.jpg) bertema museum/artefak bersejarah -->
        <img src="https://unsplash.com" 
             alt="Default Banner Galeri" 
             class="w-full h-full object-cover opacity-80">
    @endif

</div>
<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-8 bg-[#fffbeb]" x-data="galeriFilter()">

    <!-- Header Judul Katalog & Form Pencarian -->
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-amber-200/70">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100/80 text-amber-800 text-xs font-bold uppercase tracking-wider mb-2">
                🏛️ Koleksi Resmi Museum
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-stone-900 font-serif tracking-tight">Katalog Artefak & Pusaka</h1>
            <p class="text-sm text-stone-600 mt-1 max-w-2xl">
                Jelajahi 17 benda peninggalan bersejarah Kerajaan Talaga Manggung dari abad ke-13 hingga era Kabupaten Talaga.
            </p>
        </div>

        <!-- Form Input Search Bar (Instant Filter Client-Side) -->
        <div class="w-full md:w-80 shrink-0">
            <div class="relative">
                <input type="text" 
                       x-model="searchQuery" 
                       @input="filterItems()"
                       placeholder="Cari nama artefak, keris, arca..." 
                       class="w-full bg-white border border-stone-300 rounded-full pl-10 pr-10 py-2.5 text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 shadow-sm transition">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                    🔍
                </div>
                <button x-show="searchQuery" 
                        @click="searchQuery = ''; filterItems()" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-700 text-xs font-bold">
                    ✕
                </button>
            </div>
        </div>
    </div>

    <!-- Bilah Filter Kategori Standar Profesional (Flex Wrap di Desktop & Smooth Scroll di Mobile) -->
    <div class="mb-6">
        <div class="flex flex-wrap items-center gap-2">
            <!-- Tombol Semua Kategori -->
            <button @click="setCategory('')" 
                    :class="selectedCategory === '' ? 'bg-amber-800 text-white shadow-md shadow-amber-900/20 ring-2 ring-amber-800/30' : 'bg-white text-stone-700 border border-stone-200/80 hover:border-amber-500 hover:text-amber-700 hover:bg-amber-50/50'"
                    class="px-4 py-2 text-xs font-bold rounded-full transition-all duration-200 cursor-pointer">
                Semua Katalog (17)
            </button>

            @foreach($kategoriList as $kat)
                <button @click="setCategory('{{ $kat }}')" 
                        :class="selectedCategory === '{{ $kat }}' ? 'bg-amber-800 text-white shadow-md shadow-amber-900/20 ring-2 ring-amber-800/30' : 'bg-white text-stone-700 border border-stone-200/80 hover:border-amber-500 hover:text-amber-700 hover:bg-amber-50/50'"
                        class="px-4 py-2 text-xs font-bold rounded-full transition-all duration-200 cursor-pointer">
                    {{ $kat }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Status Hasil Filter & Pencarian Instant -->
    <div x-show="searchQuery || selectedCategory" 
         x-transition
         class="mb-8 p-4 bg-amber-100/70 border border-amber-200 rounded-2xl flex flex-wrap items-center justify-between gap-3 text-xs text-amber-900">
        <div class="flex flex-wrap items-center gap-2">
            <span>Menampilkan <strong x-text="visibleCount">17</strong> artefak</span>
            <template x-if="selectedCategory">
                <span class="bg-amber-200/80 text-amber-900 px-2.5 py-0.5 rounded-full font-semibold flex items-center gap-1">
                    Kategori: <span x-text="selectedCategory"></span>
                    <button @click="setCategory('')" class="hover:text-red-700 font-bold ml-1">✕</button>
                </span>
            </template>
            <template x-if="searchQuery">
                <span class="bg-amber-200/80 text-amber-900 px-2.5 py-0.5 rounded-full font-semibold flex items-center gap-1">
                    Cari: "<span x-text="searchQuery"></span>"
                    <button @click="searchQuery = ''; filterItems()" class="hover:text-red-700 font-bold ml-1">✕</button>
                </span>
            </template>
        </div>
        <button @click="resetAll()" class="font-bold text-amber-800 hover:text-amber-950 underline text-xs cursor-pointer">
            Reset Semua Filter ↺
        </button>
    </div>

    <!-- Grid Foto (Filter Client-Side Instan) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($galeri as $item)
            <!-- Item Foto / Artefak -->
            <div x-show="isItemVisible('{{ addslashes($item->kategori) }}', '{{ addslashes(strtolower($item->judul)) }}', '{{ addslashes(strtolower($item->deskripsi ?? '')) }}')"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="flex flex-col relative group bg-white border border-stone-200/60 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                
                <!-- Pembungkus Gambar Thumbnail -->
                <div class="overflow-hidden aspect-[4/3] bg-stone-100 relative">
                    <img src="{{ \Illuminate\Support\Str::startsWith($item->foto, 'http') ? $item->foto : (\Illuminate\Support\Str::startsWith($item->foto, 'images/') ? asset($item->foto) : asset('storage/' . $item->foto)) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    
                    <!-- Badge Indikator Konten 3D di Atas Gambar -->
                    @if($item->link_3d)
                        <span class="absolute top-3 right-3 bg-amber-600 text-white text-[10px] font-black px-2.5 py-1 rounded-md shadow-md uppercase tracking-wider animate-pulse">
                            3D Model
                        </span>
                    @endif
                </div>

                <!-- Detail Konten -->
                <div class="p-4 bg-white flex-grow flex flex-col justify-between gap-4">
                    <div>
                        <p class="text-[10px] font-bold text-amber-600 uppercase tracking-wider">{{ $item->kategori }}</p>
                        <h3 class="text-sm font-semibold text-stone-800 mt-1 group-hover:text-amber-600 transition-colors">{{ $item->judul }}</h3>
                        @if($item->deskripsi)
                            <p class="text-xs text-stone-500 mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
                        @endif
                    </div>

                    <div class="pt-2 border-t border-stone-100 flex flex-col gap-2">
                        <a href="{{ route('galeri.show', $item) }}" class="w-full inline-flex items-center justify-center bg-stone-800 hover:bg-stone-900 text-white font-bold text-xs px-3 py-2.5 rounded-xl transition duration-200">
                            Lihat Detail
                        </a>

                        @if($item->link_3d)
                            <a href="{{ $item->link_3d }}" target="_blank" rel="noopener noreferrer" 
                               class="w-full inline-flex items-center justify-center space-x-2 bg-amber-700 hover:bg-amber-800 text-white font-bold text-xs px-3 py-2.5 rounded-xl transition duration-200 shadow-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-3-3M21 7.5l-3 3M21 7.5H8.25m0 0l3 3m-3-3l3-3M3 12h.008v.008H3V12zm0 4.5h.008v.008H3v-.008zm0-9h.008v.008H3V7.5z" />
                                </svg>
                                <span>Lihat Artefak 3D</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <!-- State Jika Hasil Pencarian Kosong -->
        <div x-show="visibleCount === 0" 
             x-transition
             class="col-span-full py-16 px-4 text-center bg-white border border-dashed border-amber-200 rounded-3xl">
            <div class="text-4xl mb-3">🔍</div>
            <h3 class="text-base font-bold text-stone-800">Tidak ada artefak yang ditemukan</h3>
            <p class="text-xs text-stone-500 mt-1">Coba gunakan kata kunci pencarian lain atau ganti kategori filter.</p>
            <button @click="resetAll()" class="mt-4 inline-block bg-amber-700 hover:bg-amber-800 text-white text-xs font-bold px-4 py-2 rounded-xl transition cursor-pointer">
                Lihat Semua Katalog Artefak
            </button>
        </div>

    </div>
</main>

<script>
    function galeriFilter() {
        return {
            searchQuery: '{{ addslashes($kataKunci ?? "") }}',
            selectedCategory: '{{ addslashes($kategoriTerpilih ?? "") }}',
            visibleCount: 17,

            init() {
                this.updateCount();
            },

            setCategory(cat) {
                this.selectedCategory = cat;
                this.filterItems();
            },

            isItemVisible(kategori, judul, deskripsi) {
                const matchCategory = !this.selectedCategory || kategori === this.selectedCategory;
                const query = this.searchQuery.toLowerCase().trim();
                const matchSearch = !query || judul.includes(query) || deskripsi.includes(query) || kategori.toLowerCase().includes(query);
                
                return matchCategory && matchSearch;
            },

            filterItems() {
                this.$nextTick(() => {
                    this.updateCount();
                    this.updateURL();
                });
            },

            updateCount() {
                const items = document.querySelectorAll('[x-show^="isItemVisible"]');
                let count = 0;
                items.forEach(el => {
                    if (el.style.display !== 'none') {
                        count++;
                    }
                });
                this.visibleCount = count;
            },

            updateURL() {
                const params = new URLSearchParams();
                if (this.selectedCategory) params.set('kategori', this.selectedCategory);
                if (this.searchQuery) params.set('search', this.searchQuery);
                
                const newURL = `${window.location.pathname}${params.toString() ? '?' + params.toString() : ''}`;
                window.history.replaceState({}, '', newURL);
            },

            resetAll() {
                this.searchQuery = '';
                this.selectedCategory = '';
                this.filterItems();
            }
        }
    }
</script>

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
