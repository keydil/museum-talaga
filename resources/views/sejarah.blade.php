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
            <a href="{{ url('/') }}" class="hover:text-amber-700 transition">Beranda</a>

            <!-- DROPDOWN 1: PROFIL (DESKTOP HIGHLIGHT STRUKTUR ORGANISASI) -->
            <div class="relative inline-block text-left">
                <!-- Tombol utama 'Profil' ikut berwarna amber saat sub-menu Struktur Organisasi aktif -->
                <button onclick="toggleDropdown(event, 'menuProfil')" class="flex items-center {{ request()->routeIs('sejarah') ? 'text-amber-600 font-semibold' : '' }} hover:text-amber-700 transition gap-1 focus:outline-none">
                    Profil <span class="text-[9px]">▼</span>
                </button>
                <div id="menuProfil" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                    <a href="{{ route('sejarah')}}" class="block px-4 py-2.5 text-xs  {{ request()->routeIs('sejarah') ? 'bg-amber-50 text-amber-600 font-bold border-l-4 border-amber-500' : 'text-stone-700' }}  hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Sejarah</a>
                    <a href="{{ route('visimisi')}}" class="block px-4 py-2.5 text-xs text-stone-700 hover:bg-amber-50 hover:text-amber-800 border-b border-amber-100">Visi & Misi</a>
                    
                    <!-- HIGHLIGHT STRUKTUR ORGANISASI DESKTOP -->
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

        <!-- DROPDOWN PROFIL (SELULER HIGHLIGHT STRUKTUR ORGANISASI) -->
        <!-- Otomatis menambahkan atribut 'open' jika rute strukturorg aktif agar langsung menggelar terbuka -->
        <details class="group my-1">
            <summary class="flex items-center justify-between w-full text-sm font-medium hover:text-amber-700 cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-1.5">
                    Profil 
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>

           <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
    <!-- SEJARAH AKTIF -->
    <a href="{{ route('sejarah') }}" wire:navigate 
       class="block text-xs transition text-amber-600 font-bold border-l-2 border-amber-500 -ml-[17px] pl-[15px]">
       Sejarah
    </a>
    
    <a href="{{ route('visimisi') }}" wire:navigate class="block text-stone-500 hover:text-amber-700 text-xs transition">Visi & Misi</a>
    <a href="{{ route('strukturorg') }}" wire:navigate class="block hover:text-amber-700 text-xs transition">Struktur Organisasi</a>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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


<!-- 2. KONTEN UTAMA: HALAMAN SEJARAH DINAMIS -->
<div class="w-full mb-16 overflow-hidden aspect-[3/1] md:aspect-[21/9] lg:aspect-[3.5/1] bg-stone-900 shadow-sm">
    
    <!-- Gambar Latar Belakang Dinamis Khusus Halaman Sejarah -->
    <!-- 🔴 Mengambil data khusus array key 'sejarah' -->
    @if(isset($banners) && isset($banners['sejarah']))
        <img src="{{ asset('storage/' . $banners['sejarah']) }}" 
             alt="Header Banner Sejarah" 
             class="w-full h-full object-cover">
    @else
        <!-- Gambar Default bertema teks/manuskrip/arsip sejarah lama jika admin belum upload -->
        <img src="https://unsplash.com" 
             alt="Default Banner Sejarah" 
             class="w-full h-full object-cover opacity-80">
    @endif

</div>

<main class="flex-grow max-w-4xl w-full mx-auto px-6 py-12 bg-[#fdfbf2] font-sans">
    
    <!-- Bagian Judul dan Abstrak Sejarah -->
    {{-- <div class="text-center mb-12 flex flex-col items-center" data-aos="fade-down" data-aos-duration="800">
        <h1 class="text-3xl md:text-5xl font-black text-amber-800 tracking-tight leading-tight">
            {{ $sejarahData['sejarah_title'] ?? 'Sejarah Kerajaan Talaga Manggung' }}
        </h1>
        <p class="mt-4 text-stone-600 text-sm md:text-base leading-relaxed max-w-2xl italic">
            "{{ $sejarahData['sejarah_subtitle'] ?? 'Menelusuri jejak luhur peradaban, titisan benda pusaka, dan kronik kegemilangan masa lalu institusi.' }}"
        </p>
        <div class="h-0.5 w-16 bg-amber-600 rounded-full mt-6"></div>
    </div> --}}

    <!-- Wadah Artikel Narasi Panjang dengan Animasi -->
    <div class="bg-white border border-amber-200/60 rounded-2xl p-8 md:p-12 shadow-sm text-stone-700 leading-relaxed tracking-wide text-justify space-y-8"
         data-aos="fade-up"
         data-aos-duration="1000"
         data-aos-delay="200">

        <!-- Prolog -->
        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="space-y-6">
            <div class="flex flex-col md:flex-row gap-6 items-start">
                <div class="md:w-2/5 w-full overflow-hidden rounded-2xl border border-amber-200 shadow-sm">
                    <img src="{{ Vite::asset('resources/images/museumtalagamanggung.png') }}" alt="Museum Talaga Manggung" class="w-full h-full object-cover">
                </div>
                <div class="md:w-3/5 space-y-4">
                    <p class="inline-block rounded-full bg-amber-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-amber-800">Prolog</p>
                    <p class="text-lg leading-relaxed first-letter:text-5xl first-letter:font-black first-letter:text-amber-700 first-letter:mr-3 first-letter:float-left first-letter:leading-none">
                        Terletak di sebuah hutan kecil di Desa Talagawetan, Kecamatan Talaga, Kabupaten Majalengka, Museum Talaga Manggung merupakan tempat penyimpanan benda-benda peninggalan masa kejayaan Kerajaan Talaga.
                    </p>
                    <p class="text-stone-600 text-sm leading-relaxed">
                        Pada masa Raja ke-IX Kerajaan Talaga, Raja Talaga Manggung yang kala itu bernama Rd. Apun Surawidjaja, mendirikan satu tempat untuk melaksanakan tatanan pemerintahan di Talaga. Tempat itu kemudian disebut Bhumi Ageung, yang sekarang menjadi rumah peninggalan kebudayaan Talaga Manggung, dan kini menjadi rumah pribadi para keturunan Raja dan Ratu Talaga.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 py-2">
            <div class="flex-grow h-0.5 bg-gradient-to-r from-amber-600 to-transparent rounded-full"></div>
            <span class="text-amber-700 font-semibold text-sm">✦</span>
            <div class="flex-grow h-0.5 bg-gradient-to-l from-amber-600 to-transparent rounded-full"></div>
        </div>

        <!-- Bhumi Ageung -->
        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="space-y-6">
            <div class="flex flex-col md:flex-row gap-6 items-start">
                <div class="md:w-3/5 space-y-4">
                    <h3 class="text-xl font-black text-amber-900">Bhumi Ageung Talaga</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">
                        Bhumi Ageung Talaga merupakan bekas pusat tata kelola pemerintahan Kerajaan Talaga Manggung. Tepat di sebelahnya, beliau mendirikan sebuah bangunan kecil yang berfungsi sebagai gudang penyimpanan senjata dan barang-barang penting kerajaan, yang disebut Bhumi Alit.
                    </p>
                    <p class="text-stone-600 text-sm leading-relaxed">
                        Sepeninggal Rd. Apun Surawidjaja, muncul berbagai konflik akibat politik adu domba kaum kolonial. Pada suatu masa, Kerajaan Talaga Manggung tidak lagi menjadi bentuk pemerintahan sebuah negara, melainkan berubah menjadi pemerintahan tradisional Ka-Tumenggungan atau Ka-Adipatian di bawah administrasi kolonial. Nama wilayah Kerajaan Talaga Manggung pun berubah menjadi Ka-Adipatian atau Ka-Tumenggungan Talaga.
                    </p>
                </div>
                <div class="md:w-2/5 w-full overflow-hidden rounded-2xl border border-stone-200 shadow-sm">
                    <img src="{{ Vite::asset('resources/images/Bhumi_Ageung_Talaga.png') }}" alt="Bhumi Ageung Talaga" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <!-- Perpecahan dan penyatuan -->
        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500" class="bg-gradient-to-br from-amber-50 to-white rounded-2xl p-6 border border-amber-200/50">
            <h3 class="text-lg font-bold text-stone-900 mb-4">Jejak Sejarah yang Terpecah, Lalu Dipersatukan</h3>
            <p class="text-stone-600 text-sm leading-relaxed">
                Pada tahun 1715 M, Adipati Wiranata yang merupakan keturunan Rd. Apun Surawidjaja, hendak dinobatkan sebagai pemimpin Talaga. Namun, muncul protes dari putra Pangeran Kusumayuda yang bernama Pangeran Natadilaga. Kondisi ini lalu dimanfaatkan oleh kaum kolonial untuk memecah belah Wangsa Talaga melalui Ordonansi Staatsblad, dengan keputusan bahwa Talaga dibagi menjadi dua, yakni Kesultanan Talagakidul dipimpin oleh Adipati Wiranata dan Kesultanan Talagakaler dipimpin oleh Pangeran Natadilaga.
            </p>
            <p class="mt-3 text-stone-600 text-sm leading-relaxed">
                Gelombang pergolakan pun semakin kuat. Talaga kemudian dibagi menjadi empat kabupaten: Talagakidul, Talagakaler, Talagawetan, dan Talagakulon. Pada awal abad ke-19, Pangeran Arya Sacanata II (Rd. Regasari) berinisiatif menyatukan kembali Talaga. Namun, sesuai rencana Hindia Belanda, Talaga digabung dengan wilayah lain dan ibukota dipindahkan ke Sindangkasih. Pangeran Sacanata II menolak, akhirnya diberhentikan dari jabatannya dan mendapat julukan Bupati Panungtung Talaga.
            </p>
        </div>

        <!-- Para sesepuh -->
        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600" class="space-y-4">
            <h3 class="text-lg font-bold text-stone-900">Para Sesepuh Penjaga Benda Pusaka Karuhun</h3>
            <p class="text-stone-600 text-sm leading-relaxed">
                Karena sejak pasca penggabungan antara Kabupaten Talaga dan Sindangkasih tidak ada yang memegang kekuasaan secara politik, para sesepuh Talaga bermusyawarah untuk menentukan orang yang akan mengurus benda-benda pusaka karuhun. Disepakati bahwa yang berhak mengurus benda-benda itu adalah keturunan yang memiliki hubungan langsung dari Pangeran Sacanata II dari pihak anak laki-laki; jika anak laki-laki tidak ada, pihak perempuan diperbolehkan asal memiliki anak laki-laki yang kemudian kembali memegang pengurusan benda pusaka.
            </p>
            <div class="grid gap-3 md:grid-cols-2">
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 text-sm text-stone-700">
                    <p class="font-semibold text-stone-900">1. Pangeran Sumanagara (1820-1840)</p>
                    <p class="mt-1">Putra sulung Pangeran Arya Sacanata II.</p>
                </div>
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 text-sm text-stone-700">
                    <p class="font-semibold text-stone-900">2. Nyi Raden Anggrek (1840-1865)</p>
                    <p class="mt-1">Putri Pangeran Sumanagara.</p>
                </div>
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 text-sm text-stone-700">
                    <p class="font-semibold text-stone-900">3. Raden Natakusumah (1865-1895)</p>
                    <p class="mt-1">Putra Nyi Raden Anggrek.</p>
        				</div>
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 text-sm text-stone-700">
                    <p class="font-semibold text-stone-900">4. Raden Natadiputra (1895-1925)</p>
                    <p class="mt-1">Putra Raden Natakusumah.</p>
                </div>
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 text-sm text-stone-700">
                    <p class="font-semibold text-stone-900">5. Nyi Raden Masri’ah (1925-1948)</p>
                    <p class="mt-1">Putri Raden Natadiputra.</p>
                </div>
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 text-sm text-stone-700">
                    <p class="font-semibold text-stone-900">6. Raden Acap Kartadilaga (1948-1970)</p>
                    <p class="mt-1">Suami Nyi Raden Masri’ah.</p>
                </div>
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 text-sm text-stone-700">
                    <p class="font-semibold text-stone-900">7. Nyi Raden Madinah (1970-1993)</p>
                    <p class="mt-1">Putri Raden Acap Kartadilaga.</p>
                </div>
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 text-sm text-stone-700">
                    <p class="font-semibold text-stone-900">8. Nyi Raden Padnalarag (1993-2014)</p>
                    <p class="mt-1">Putri Nyi Raden Madinah.</p>
                </div>
                <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 text-sm text-stone-700 md:col-span-2">
                    <p class="font-semibold text-stone-900">9. Raden Apun Tjahya Hendraningrat (2014-sekarang)</p>
                    <p class="mt-1">Putra Nyi Raden Padnalarang.</p>
                </div>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700" class="border-l-4 border-amber-700 pl-6 py-2 italic text-stone-700 bg-amber-50/50 rounded-r-lg">
            <p>
                Sejak saat itulah, Bhumi Alit berubah fungsi menjadi Museum Talaga Manggung — rumah ingatan, rumah pusaka, dan rumah sejarah yang terus dijaga oleh para keturunan Talaga.
            </p>
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
</script>
