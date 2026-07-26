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

    <!-- 2. BAGIAN HERO STATIS (Dengan Animasi Elegan & Kata-kata Sapa yang Menarik) -->
    <section class="relative isolate overflow-hidden pt-20 pb-24 flex items-center min-h-[80vh] border-b border-amber-200 bg-gradient-to-b from-amber-50 to-amber-100/40">
        <!-- Efek dekoratif background -->
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute top-0 right-0 -mr-40 -mt-40 w-80 h-80 bg-amber-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-80 h-80 bg-amber-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="mx-auto max-w-7xl px-6 lg:px-8 relative z-10">
            <div class="mx-auto max-w-3xl text-center">
                <!-- Badge dengan animasi bounce -->
                <span data-aos="bounce-in" data-aos-duration="800" data-aos-delay="200" class="inline-flex items-center rounded-full bg-amber-600/15 px-4 py-1.5 text-xs font-semibold text-amber-800 ring-1 ring-inset ring-amber-600/30 mb-6 backdrop-blur-sm hover:bg-amber-600/25 transition-all duration-300">
                    ✨ Selamat Datang di Museum Talaga Manggung
                </span>

                <!-- Judul dengan efek zoom in -->
                <h1 data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300" class="text-5xl md:text-7xl font-black tracking-tight text-stone-900 sm:text-8xl leading-[1.1] mb-2">
                    Jelajahi <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-700 via-amber-600 to-amber-500">Warisan Sejarah</span>
                </h1>

                <!-- Subtitle dengan typing effect -->
                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500" class="mt-8 text-xl md:text-2xl font-semibold text-stone-700">
                    Lengkapi perjalanan budaya Anda bersama kami
                </p>

                <!-- Deskripsi dengan fade -->
                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700" class="mt-6 text-lg font-normal text-stone-600 sm:text-xl/8 max-w-2xl mx-auto leading-relaxed">
                    Rasakan keajaiban koleksi pameran eksklusif kami, dari artefak bersejarah hingga dokumentasi digital interaktif yang menceritakan kisah-kisah berharga peradaban kita.
                </p>

                <!-- CTA Buttons dengan animasi -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900" class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-6">
                    <a href="#pameran" class="group inline-flex items-center rounded-xl bg-gradient-to-r from-amber-700 to-amber-600 px-8 py-4 text-lg font-bold text-white shadow-lg hover:shadow-2xl hover:scale-105 transform transition-all duration-300">
                        <span>Jelajahi Koleksi</span>
                        <svg class="ml-3 w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#tentang" class="group inline-flex items-center px-8 py-4 text-lg font-semibold text-stone-700 border-2 border-amber-700 rounded-xl hover:bg-amber-700 hover:text-white transition-all duration-300">
                        <span>Tentang Museum</span>
                        <svg class="ml-3 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Scroll indicator dengan animasi -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="1100" class="mt-16 flex justify-center">
                    <div class="inline-flex flex-col items-center">
                        <span class="text-xs font-semibold text-stone-500 uppercase tracking-widest mb-2">Scroll untuk lanjut</span>
                        <div class="animate-bounce">
                            <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. BAGIAN TENTANG MUSEUM STATIS (Dengan Animasi Elegan) -->
    <section id="tentang" class="py-32 border-b border-amber-200 bg-gradient-to-b from-transparent to-amber-100/50 overflow-hidden">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-16 lg:grid-cols-2 items-center">
                <!-- Konten Teks di Sisi Kiri dengan Animasi Fade Right -->
                <div data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200" class="space-y-8">
                    <!-- Badge Section -->
                    <div>
                        <span class="inline-block text-xs font-bold text-amber-700 uppercase tracking-[0.15em] mb-3">📚 Tentang Kami</span>
                        <h2 class="text-5xl md:text-6xl font-black text-stone-900 leading-tight mb-6">
                            Museum <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-700 to-amber-600">Talaga Manggung</span>
                        </h2>
                    </div>

                    <!-- Deskripsi Utama -->
                    <div class="space-y-6">
                        <p class="text-lg text-stone-700 leading-relaxed">
                            <strong>Museum Talaga Manggung</strong> adalah wadah pelestarian benda pusaka, manuskrip kuno, dan rekam jejak sejarah peradaban institusi yang penuh dengan makna mendalam.
                        </p>
                        
                        <p class="text-lg text-stone-600 leading-relaxed">
                            Kami berkomitmen untuk menyajikan koleksi pameran eksklusif yang tidak hanya menghibur, tetapi juga mendidik pengunjung tentang kekayaan budaya dan sejarah yang kami miliki.
                        </p>

                        <p class="text-lg text-stone-600 leading-relaxed">
                            Setiap artefak, dokumen, dan karya seni di museum kami menceritakan kisah yang unik tentang perjalanan peradaban kita. Bergabunglah dengan kami dalam menjelajahi warisan budaya yang bernilai tinggi.
                        </p>
                    </div>

                    <!-- Stats dengan Animasi -->
                    <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="grid grid-cols-3 gap-6 pt-8 border-t-2 border-amber-200">
                        <div class="text-center hover:scale-105 transition-transform">
                            <div class="text-3xl font-black text-amber-700">500+</div>
                            <div class="text-sm text-stone-600 font-semibold mt-1">Koleksi Artefak</div>
                        </div>
                        <div class="text-center hover:scale-105 transition-transform">
                            <div class="text-3xl font-black text-amber-700">50K+</div>
                            <div class="text-sm text-stone-600 font-semibold mt-1">Pengunjung Tahunan</div>
                        </div>
                        <div class="text-center hover:scale-105 transition-transform">
                            <div class="text-3xl font-black text-amber-700">100+</div>
                            <div class="text-sm text-stone-600 font-semibold mt-1">Program Edukasi</div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                        <a href="#pameran" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-amber-700 to-amber-600 text-white font-bold rounded-lg hover:shadow-lg hover:scale-105 transform transition-all duration-300">
                            Jelajahi Lebih Lanjut
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Konten Visual di Sisi Kanan dengan Animasi Fade Left -->
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400" class="space-y-6">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl border-2 border-amber-200 p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="text-4xl">🏛️</div>
                            <div>
                                <h3 class="text-lg font-bold text-stone-900 mb-2">Arsitektur Bersejarah</h3>
                                <p class="text-stone-600 text-sm">Bangunan utama museum menampilkan arsitektur tradisional yang melestarikan identitas budaya lokal.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl border-2 border-amber-200 p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="text-4xl">📚</div>
                            <div>
                                <h3 class="text-lg font-bold text-stone-900 mb-2">Koleksi Lengkap</h3>
                                <p class="text-stone-600 text-sm">Ribuan manuskrip, artefak, dan dokumen bersejarah terawat dengan teknologi modern terkini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-2xl border-2 border-amber-200 p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="text-4xl">👥</div>
                            <div>
                                <h3 class="text-lg font-bold text-stone-900 mb-2">Program Komunitas</h3>
                                <p class="text-stone-600 text-sm">Kami mengadakan berbagai workshop, seminar, dan acara pendidikan untuk masyarakat umum.</p>
                            </div>
                        </div>
                    </div>
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


<!-- 3. KAKI HALAMAN (FOOTER) RESPONSIF DENGAN GOOGLE MAP -->
<!-- FOOTER STATIS DENGAN TIGA KOLOM DAN GOOGLE MAP -->
<footer class="bg-[#1c1917] text-stone-400 text-xs border-t border-stone-800 font-sans mt-auto w-full overflow-hidden">
    <!-- BAGIAN KONTEN TIGA KOLOM -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <!-- KOLOM 1: INFORMASI MUSEUM -->
            <div class="flex flex-col justify-between space-y-2">
                <div>
                    <h3 class="text-white font-serif font-black text-sm tracking-tight mb-2">Museum Talaga Manggung</h3>
                    <p class="text-stone-500 leading-relaxed text-[11px]">Wadah pelestarian benda pusaka, manuskrip kuno, dan rekam jejak sejarah peradaban institusi.</p>
                </div>
                <p class="text-stone-600 pt-4 md:pt-0">© 2026 Hak Cipta Dilindungi.</p>
            </div>

            <!-- KOLOM 2: AKSES CEPAT -->
            <div class="flex flex-col space-y-2.5">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1">Akses Cepat</h4>
                <div class="grid grid-cols-2 gap-x-4 gap-y-2 max-w-xs mx-auto md:mx-0 text-left">
                    <a href="/" class="hover:text-white hover:underline transition">Beranda</a>
                    <a href="/berita" class="hover:text-white hover:underline transition">Berita</a>
                    <a href="/galeri" class="hover:text-white hover:underline transition">Galeri</a>
                    <a href="/gosali" class="hover:text-white hover:underline transition">Gosali</a>
                </div>
            </div>

            <!-- KOLOM 3: INFORMASI HUKUM -->
            <div class="flex flex-col space-y-2.5">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1">Informasi Hukum</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white transition">Bantuan & Kontak</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- BAGIAN GOOGLE MAP -->
    <div class="bg-[#2d2520] border-t border-stone-800 py-8">
        <div class="max-w-7xl mx-auto px-6">
            <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-4 text-center md:text-left">Lokasi Museum</h4>
            <div class="w-full h-64 md:h-80 rounded-lg overflow-hidden shadow-lg">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8271234567890!2d107.5!3d-7.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMuseum%20Talaga%20Manggung!5e0!3m2!1sid!2sid!4v1626000000000" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
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
