<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Museum & Arsip Sejarah</title>
    <!-- Menghubungkan aset CSS & JS lokal Laravel (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Mengubah total latar belakang body menjadi tema krem muda yang hangat -->
<body class="bg-amber-50 text-stone-900 antialiased font-sans min-h-screen">

    <!-- 1. BILAH NAVIGASI (NAVBAR) - Diperbarui ke tema muda -->
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
            <a href="#" class="text-amber-500 hover:text-amber-700 transition">Beranda</a>

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
        <!-- KUNCI PERUBAHAN: Ditambahkan z-50 relatif agar tetap berada di atas panel menu putih saat dibuka -->
        <div class="flex items-center md:hidden relative z-50">
            <button id="mobile-menu-button" type="button" class="text-stone-600 hover:text-amber-700 focus:outline-none p-2 rounded-md hover:bg-amber-50 transition" aria-label="Toggle menu">
                <!-- Ikon Hamburger Dinamis (Berubah jadi X saat menu terbuka) -->
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
    <!-- KUNCI PERUBAHAN: top-20 disesuaikan dengan tinggi header h-20 agar tidak tumpang tindih -->
    <div id="mobile-menu" class="hidden fixed top-20 left-0 right-0 md:hidden border-t border-amber-100 bg-white/95 px-6 py-4 space-y-3 text-sm font-medium text-stone-600 shadow-xl z-40 transition-all duration-300">

        <!-- MENU AKTIF SELULER: Beranda -->
        <a href="{{ url('/') }}" wire:navigate class="block text-amber-500 hover:text-amber-700 py-1 transition">Beranda</a>

        <!-- DROPDOWN PROFIL -->
        <details class="group my-1">
            <summary class="flex items-center justify-between w-full text-sm font-medium text-stone-600 hover:text-amber-700 cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-1.5">
                    Profil 
                </span>
                <!-- Perbaikan xmlns: Menggunakan URL resmi w3 agar tampil di semua tipe HP -->
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

<!-- 1. Pastikan CDN CSS AOS Tertulis dengan Benar -->
<link rel="stylesheet"
      href="https://unpkg.com/aos@2.3.4/dist/aos.css">

<main class="bg-[#fdfbf2]">

    <!-- 2. BAGIAN HERO (Menggunakan Efek Fade Up Keseluruhan) -->
    <section data-aos="fade-up" data-aos-duration="1000" class="relative isolate overflow-hidden pt-20 pb-24 flex items-center min-h-[80vh] border-b border-amber-200">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <!-- Elemen di dalam menggunakan delay agar muncul berurutan (Staggered) -->
                <span data-aos="fade-down" data-aos-duration="800" data-aos-delay="200" class="inline-flex items-center rounded-full bg-amber-600/10 px-4 py-1.5 text-xs font-medium text-amber-800 ring-1 ring-inset ring-amber-600/20 mb-6">
                    {{ $heroBadge }}
                </span>

                <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="text-4xl md:text-6xl font-black tracking-tight text-stone-900 sm:text-7xl leading-[1.15]">
                    {!! str_replace('Arsip Digital', '<span class="text-amber-700">Arsip Digital</span>', $heroTitle) !!}
                </h1>

                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600" class="mt-8 text-lg font-normal text-stone-600 sm:text-xl/8">
                    {{ $heroDescription }}
                </p>

                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800" class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="#pameran" class="rounded-lg bg-amber-700 px-6 py-3.5 text-base font-semibold text-white shadow-md hover:bg-amber-600 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">{{ $heroPrimaryButton }}</a>
                    <a href="#tentang" class="text-base font-semibold text-stone-700 hover:text-amber-700 transition">{{ $heroSecondaryButton }} <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. BAGIAN TENTANG (Menggunakan Efek Zoom In saat di-scroll) -->
    <section id="tentang" data-aos="zoom-in-up" data-aos-duration="1000" class="py-24 border-b border-amber-200 bg-amber-100/30 overflow-hidden">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 items-center">
                <!-- Konten teks bergeser sedikit -->
                <div data-aos="fade-right" data-aos-duration="800" data-aos-delay="300">
                    <h2 class="text-base font-semibold text-amber-700 tracking-wide uppercase">Sejarah Yayasan</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">{{ $aboutTitle }}</p>
                    <p class="mt-6 text-base text-stone-600 leading-7">{{ $aboutDescription }}</p>
                </div>
                <!-- Gambar/Mockup masuk dari kanan -->
                <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="500" class="bg-amber-100 border border-amber-200 rounded-2xl h-80 flex items-center justify-center text-amber-800/60 italic shadow-sm hover:shadow-md transition-shadow duration-300">
                    [ Area Foto: Fasilitas Museum / Gedung Utama ]
                </div>
            </div>
        </div>
    </section>

    <!-- 4. BAGIAN KOLEKSI PAMERAN (Menggunakan Efek Slide Up) -->
<section id="pameran" data-aos="slide-up" data-aos-duration="1000" class="py-24 border-b border-amber-200">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200" class="mx-auto max-w-2xl text-center mb-16">
            <h2 class="text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">{{ $cardsSectionTitle }}</h2>
            <p class="mt-4 text-stone-600">{{ $cardsSectionDescription }}</p>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($homeCards ?? [] as $card)
                <a href="{{ $card->resolved_target_url ?? url('/') }}" class="group block rounded-xl border border-amber-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-amber-500/50 hover:shadow-md">
                    
                    <!-- Pratinjau Foto atau Icon Gambar Kartu dari Storage -->
                    <div class="mb-6 flex h-44 items-center justify-center rounded-lg bg-amber-50 overflow-hidden border border-amber-100/60">
                        @if($card->icon_or_image)
                            <img src="{{ asset('storage/' . $card->icon_or_image) }}" alt="{{ $card->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <!-- Placeholder jika admin tidak mengunggah gambar -->
                            <svg class="h-12 w-12 text-amber-800/30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        @endif
                    </div>

                    <!-- Judul & Deskripsi Kartu (Disesuaikan dengan Properti Model Database) -->
                    <h3 class="text-xl font-bold text-stone-900 group-hover:text-amber-700 transition-colors">{{ $card->title }}</h3>
                    <p class="mt-3 text-sm leading-6 text-stone-600 line-clamp-3">{{ $card->description ?: 'Lihat detail konten terkait di halaman ini.' }}</p>
                </a>
            @empty
                <div class="sm:col-span-2 lg:col-span-3 rounded-xl border border-dashed border-amber-200 bg-amber-50/50 p-8 text-center text-stone-600">
                    Belum ada kartu beranda yang ditambahkan. Anda dapat menambahkannya dari menu admin.
                </div>
            @endforelse
        </div>
    </div>
</section>




</main>

<!-- 5. Script Pengaktif Animasi di Akhir Halaman -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        once: true,
        offset: 160,
        duration: 1000,
        easing: 'ease-out-cubic'
    });
});
</script>


                <!-- 3. KAKI HALAMAN (FOOTER) RESPONSIF -->
<!-- Menambahkan w-full dan overflow-hidden untuk mencegah kebocoran layar kanan -->
<footer class="bg-[#1c1917] text-stone-400 text-xs py-12 border-t border-stone-800 font-sans mt-auto w-full overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
        <div class="flex flex-col justify-between space-y-2">
            <div>
                <h3 class="text-white font-serif font-black text-sm tracking-tight mb-2">{{ $footerCol1Title }}</h3>
                <p class="text-stone-500 leading-relaxed text-[11px]">{{ $footerCol1Text }}</p>
            </div>
            <p class="text-stone-600 pt-4 md:pt-0">{{ $footerCol1Copyright }}</p>
        </div>

        <div class="flex flex-col space-y-2.5">
            <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1">{{ $footerCol2Title }}</h4>
            <div class="grid grid-cols-2 gap-x-4 gap-y-2 max-w-xs mx-auto md:mx-0 text-left">
                @foreach(explode("\n", $footerCol2Links) as $item)
                    @php($parts = array_map('trim', explode('|', $item, 2)))
                    @if(count($parts) === 2 && $parts[0] !== '')
                        <a href="{{ $parts[1] }}" class="hover:text-white hover:underline transition">{{ $parts[0] }}</a>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex flex-col space-y-2.5">
            <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1">{{ $footerCol3Title }}</h4>
            <ul class="space-y-2">
                @foreach(explode("\n", $footerCol3Links) as $item)
                    @php($parts = array_map('trim', explode('|', $item, 2)))
                    @if(count($parts) === 2 && $parts[0] !== '')
                        <li><a href="{{ $parts[1] }}" class="hover:text-white transition">{{ $parts[0] }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</footer>

</body>


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
