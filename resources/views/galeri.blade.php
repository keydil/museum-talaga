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
<main class="flex-grow max-w-7xl w-full mx-auto px-6 py-12 bg-[#fffbeb]">

    <!-- Bilah Filter Kategori Dinamis -->
    <div class="flex items-center space-x-2 overflow-x-auto pb-4 mb-10 scrollbar-none whitespace-nowrap">
        <!-- Tombol Semua Kategori -->
        <a href="{{ route('galeri') }}" 
           class="px-5 py-2 text-sm font-medium rounded-full transition-all duration-200 {{ !request('kategori') ? 'bg-amber-600 text-white shadow-md shadow-amber-600/10' : 'bg-white text-stone-600 border border-stone-200 hover:border-amber-500 hover:text-amber-600' }}">
            Semua Katalog
        </a>

        @foreach(['Arca Perunggu', 'Terracotta', 'Perlengkapan Ritual', 'Senjata Tradisional', 'Senjata Berpeledak', 'Pakaian Perlengkapan Perang', 'Etnografika', 'Keramokologika', 'Numismatika'] as $kat)
            <a href="{{ route('galeri', ['kategori' => $kat]) }}" 
               class="px-5 py-2 text-sm font-medium rounded-full transition-all duration-200 {{ request('kategori') == $kat ? 'bg-amber-600 text-white shadow-md shadow-amber-600/10' : 'bg-white text-stone-600 border border-stone-200 hover:border-amber-500 hover:text-amber-600 hover:bg-amber-50/30' }}">
                {{ $kat }}
            </a>
        @endforeach
    </div>

    <!-- Grid Foto (Dinamis Berdasarkan Data Controller) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($galeri as $item)
            <!-- Item Foto / Artefak -->
            <div class="flex flex-col relative group bg-white border border-stone-200/60 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                
                <!-- Pembungkus Gambar Thumbnail -->
                <div class="overflow-hidden aspect-[4/3] bg-stone-100 relative">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    
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
        @empty
            <!-- State Jika Data Kosong -->
            <div class="col-span-full py-16 text-center text-stone-400 text-sm italic">
                Belum ada dokumentasi foto atau artefak untuk kategori ini.
            </div>
        @endforelse

    </div>
</main>






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
