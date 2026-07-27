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
        <!-- Koreksi Gambar Default: Menggunakan file gambar asli khusus tema museum/galeri -->
        <img src="{{ asset('images/artefak/ruang_pamer.jpg') }}" 
             alt="Default Banner Galeri" 
             class="w-full h-full object-cover opacity-80">
    @endif

</div>
<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>

<main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 py-6 md:py-8 bg-[#fffbeb]">

    <!-- Header Judul Katalog & Form Pencarian -->
    <div class="mb-6 md:mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4 md:gap-6 pb-6 border-b border-amber-200/70">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-[11px] font-bold uppercase tracking-wider mb-2">
                🏛️ Koleksi Resmi Museum
            </div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-stone-900 font-serif tracking-tight">Katalog Artefak & Pusaka</h1>
            <p class="text-xs sm:text-sm text-stone-600 mt-1 max-w-2xl leading-relaxed">
                Jelajahi 17 benda peninggalan bersejarah Kerajaan Talaga Manggung dari abad ke-13 hingga era Kabupaten Talaga.
            </p>
        </div>

        <!-- Form Input Search Bar (Instant Filter Client-Side) -->
        <div class="w-full md:w-80 shrink-0">
            <div class="relative">
                <input type="text" 
                       id="galeri-search-input"
                       value="{{ $kataKunci }}" 
                       placeholder="Cari nama artefak, keris, arca..." 
                       class="w-full bg-white border border-stone-300 rounded-full pl-10 pr-10 py-2.5 text-xs sm:text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 shadow-sm transition">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-sm">
                    🔍
                </div>
                <button id="galeri-search-clear" 
                        class="hidden absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-700 text-xs font-bold">
                    ✕
                </button>
            </div>
        </div>
    </div>

    <!-- Bilah Filter Kategori Responsive (Mobile Horizontal Swipe & Desktop Flex Wrap) -->
    <div class="mb-6 overflow-hidden">
        <div id="category-pills-container" class="flex overflow-x-auto items-center gap-2 pb-2 no-scrollbar whitespace-nowrap md:flex-wrap">
            <!-- Tombol Semua Kategori -->
            <button data-kategori="" 
                    class="kat-pill-btn px-4 py-2 text-xs font-bold rounded-full transition-all duration-200 cursor-pointer shrink-0 shadow-xs border {{ !$kategoriTerpilih ? 'bg-amber-800 text-white border-amber-800 shadow-md' : 'bg-white text-stone-700 border-stone-200/90 hover:border-amber-600 hover:text-amber-700 hover:bg-amber-50/50' }}">
                Semua Katalog (17)
            </button>

            @foreach($kategoriList as $kat)
                <button data-kategori="{{ $kat }}" 
                        class="kat-pill-btn px-4 py-2 text-xs font-bold rounded-full transition-all duration-200 cursor-pointer shrink-0 shadow-xs border {{ $kategoriTerpilih == $kat ? 'bg-amber-800 text-white border-amber-800 shadow-md' : 'bg-white text-stone-700 border-stone-200/90 hover:border-amber-600 hover:text-amber-700 hover:bg-amber-50/50' }}">
                    {{ $kat }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Status Hasil Filter & Pencarian Instant -->
    <div id="filter-status-bar" 
         class="{{ ($kataKunci || $kategoriTerpilih) ? 'flex' : 'hidden' }} mb-6 p-3.5 sm:p-4 bg-amber-100/70 border border-amber-200/80 rounded-2xl flex-wrap items-center justify-between gap-3 text-xs text-amber-900 shadow-xs">
        <div class="flex flex-wrap items-center gap-2">
            <span>Menampilkan <strong id="visible-count-text">17</strong> artefak</span>
            <span id="badge-kategori" class="{{ $kategoriTerpilih ? 'inline-flex' : 'hidden' }} bg-amber-200/90 text-amber-950 px-2.5 py-0.5 rounded-full font-semibold items-center gap-1">
                Kategori: <span id="badge-kategori-text">{{ $kategoriTerpilih }}</span>
                <button id="btn-remove-kategori" class="hover:text-red-700 font-bold ml-1">✕</button>
            </span>
            <span id="badge-search" class="{{ $kataKunci ? 'inline-flex' : 'hidden' }} bg-amber-200/90 text-amber-950 px-2.5 py-0.5 rounded-full font-semibold items-center gap-1">
                Cari: "<span id="badge-search-text">{{ $kataKunci }}</span>"
                <button id="btn-remove-search" class="hover:text-red-700 font-bold ml-1">✕</button>
            </span>
        </div>
        <button id="btn-reset-all" class="font-bold text-amber-800 hover:text-amber-950 underline text-xs cursor-pointer">
            Reset Semua Filter ↺
        </button>
    </div>

    <!-- Grid Foto (Filter Client-Side Instan via Vanilla JS) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">

        @foreach($galeri as $item)
            <!-- Item Foto / Artefak Card -->
            <div class="artefak-card flex flex-col relative group bg-white border border-stone-200/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                 data-kategori="{{ $item->kategori }}"
                 data-search="{{ strtolower($item->judul . ' ' . ($item->deskripsi ?? '') . ' ' . $item->kategori) }}">
                
                <!-- Pembungkus Gambar Thumbnail -->
                <div class="overflow-hidden aspect-[4/3] bg-stone-100 relative">
                    <img src="{{ \Illuminate\Support\Str::startsWith($item->foto, 'http') ? $item->foto : (\Illuminate\Support\Str::startsWith($item->foto, 'images/') ? asset($item->foto) : asset('storage/' . $item->foto)) }}" 
                         alt="{{ $item->judul }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    
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
                        <h3 class="text-sm font-semibold text-stone-800 mt-1 group-hover:text-amber-600 transition-colors leading-snug">{{ $item->judul }}</h3>
                        @if($item->deskripsi)
                            <p class="text-xs text-stone-500 mt-1 line-clamp-2 leading-relaxed">{{ $item->deskripsi }}</p>
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
        <div id="empty-state-box" class="hidden col-span-full py-16 px-4 text-center bg-white border border-dashed border-amber-300 rounded-3xl shadow-xs">
            <div class="text-4xl mb-3">🔍</div>
            <h3 class="text-base font-bold text-stone-800">Tidak ada artefak yang ditemukan</h3>
            <p class="text-xs text-stone-500 mt-1">Coba gunakan kata kunci pencarian lain atau ganti kategori filter.</p>
            <button id="btn-empty-reset" class="mt-4 inline-block bg-amber-700 hover:bg-amber-800 text-white text-xs font-bold px-4 py-2 rounded-xl transition cursor-pointer">
                Lihat Semua Katalog Artefak
            </button>
        </div>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('galeri-search-input');
        const clearBtn = document.getElementById('galeri-search-clear');
        const pillButtons = document.querySelectorAll('.kat-pill-btn');
        const cards = document.querySelectorAll('.artefak-card');
        const emptyState = document.getElementById('empty-state-box');
        const statusBar = document.getElementById('filter-status-bar');
        const visibleCountText = document.getElementById('visible-count-text');
        
        const badgeKat = document.getElementById('badge-kategori');
        const badgeKatText = document.getElementById('badge-kategori-text');
        const btnRemoveKat = document.getElementById('btn-remove-kategori');

        const badgeSearch = document.getElementById('badge-search');
        const badgeSearchText = document.getElementById('badge-search-text');
        const btnRemoveSearch = document.getElementById('btn-remove-search');
        
        const btnResetAll = document.getElementById('btn-reset-all');
        const btnEmptyReset = document.getElementById('btn-empty-reset');

        let currentCategory = "{{ $kategoriTerpilih ?? '' }}";
        let currentQuery = "{{ $kataKunci ?? '' }}";

        function applyFilter() {
            let visibleCount = 0;
            const query = currentQuery.toLowerCase().trim();

            cards.forEach(card => {
                const cardKat = card.getAttribute('data-kategori');
                const cardSearch = card.getAttribute('data-search');

                const matchKat = !currentCategory || cardKat === currentCategory;
                const matchSearch = !query || cardSearch.includes(query);

                if (matchKat && matchSearch) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update visible counter
            if (visibleCountText) visibleCountText.textContent = visibleCount;

            // Empty state display
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }

            // Update status bar & badges
            if (currentCategory || query) {
                statusBar.classList.remove('hidden');
                statusBar.classList.add('flex');
            } else {
                statusBar.classList.add('hidden');
                statusBar.classList.remove('flex');
            }

            if (currentCategory) {
                badgeKat.classList.remove('hidden');
                badgeKat.classList.add('inline-flex');
                badgeKatText.textContent = currentCategory;
            } else {
                badgeKat.classList.add('hidden');
                badgeKat.classList.remove('inline-flex');
            }

            if (query) {
                badgeSearch.classList.remove('hidden');
                badgeSearch.classList.add('inline-flex');
                badgeSearchText.textContent = currentQuery;
                if (clearBtn) clearBtn.classList.remove('hidden');
            } else {
                badgeSearch.classList.add('hidden');
                badgeSearch.classList.remove('inline-flex');
                if (clearBtn) clearBtn.classList.add('hidden');
            }

            // Update active pill styling
            pillButtons.forEach(btn => {
                const btnKat = btn.getAttribute('data-kategori');
                if (btnKat === currentCategory) {
                    btn.className = 'kat-pill-btn px-4 py-2 text-xs font-bold rounded-full transition-all duration-200 cursor-pointer shrink-0 shadow-md bg-amber-800 text-white border border-amber-800';
                } else {
                    btn.className = 'kat-pill-btn px-4 py-2 text-xs font-bold rounded-full transition-all duration-200 cursor-pointer shrink-0 shadow-xs bg-white text-stone-700 border border-stone-200/90 hover:border-amber-600 hover:text-amber-700 hover:bg-amber-50/50';
                }
            });

            // Update URL search parameters without page reload
            const params = new URLSearchParams();
            if (currentCategory) params.set('kategori', currentCategory);
            if (query) params.set('search', currentQuery);
            const newURL = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
            window.history.replaceState({}, '', newURL);
        }

        // Attach category pill click listener
        pillButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                currentCategory = this.getAttribute('data-kategori');
                applyFilter();
            });
        });

        // Search input keyup/input listener
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                currentQuery = this.value;
                applyFilter();
            });
        }

        // Clear search input button
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                currentQuery = '';
                searchInput.value = '';
                applyFilter();
            });
        }

        // Remove category badge
        if (btnRemoveKat) {
            btnRemoveKat.addEventListener('click', function() {
                currentCategory = '';
                applyFilter();
            });
        }

        // Remove search badge
        if (btnRemoveSearch) {
            btnRemoveSearch.addEventListener('click', function() {
                currentQuery = '';
                if (searchInput) searchInput.value = '';
                applyFilter();
            });
        }

        // Reset all buttons
        [btnResetAll, btnEmptyReset].forEach(btn => {
            if (btn) {
                btn.addEventListener('click', function() {
                    currentCategory = '';
                    currentQuery = '';
                    if (searchInput) searchInput.value = '';
                    applyFilter();
                });
            }
        });

        // Initial filter run on page load
        applyFilter();
    });
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
