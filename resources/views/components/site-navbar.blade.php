<!-- BILAH NAVIGASI (NAVBAR) SAKRAL & MODULAR MUSEUM -->
<header class="border-b border-amber-200 bg-white/85 backdrop-blur-md sticky top-0 z-50 shadow-sm font-sans">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between gap-4">

        <!-- LOGO UTAMA -->
        <div class="flex items-center tracking-wide shrink-0">
            <a href="{{ route('welcome') }}" wire:navigate class="block hover:opacity-90 transition">
                <img src="{{ Vite::asset('resources/images/image_ee43ecbd.svg') }}"
                     alt="Museum Talaga Manggung"
                     class="h-auto max-h-12 w-auto object-contain" />
            </a>
        </div>

        <!-- MENU DESKTOP -->
        <nav class="hidden md:flex items-center space-x-6 text-xs md:text-sm font-medium text-stone-700 whitespace-nowrap ml-auto">
            <a href="{{ route('welcome') }}" wire:navigate 
               class="{{ request()->routeIs('welcome') ? 'text-amber-700 font-bold border-b-2 border-amber-600 pb-1' : 'hover:text-amber-700 transition' }}">
               Beranda
            </a>

            <!-- DROPDOWN 1: PROFIL -->
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown(event, 'menuProfil')" 
                        class="flex items-center {{ request()->routeIs(['sejarah', 'visimisi', 'strukturorg']) ? 'text-amber-700 font-bold' : 'hover:text-amber-700' }} transition gap-1 focus:outline-none py-1">
                    Profil <span class="text-[9px]">▼</span>
                </button>
                <div id="menuProfil" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                    <a href="{{ route('sejarah') }}" wire:navigate 
                       class="block px-4 py-2.5 text-xs {{ request()->routeIs('sejarah') ? 'bg-amber-50 text-amber-800 font-bold border-l-4 border-amber-600' : 'text-stone-700 hover:bg-amber-50 hover:text-amber-800' }} border-b border-amber-100">
                       Sejarah
                    </a>
                    <a href="{{ route('visimisi') }}" wire:navigate 
                       class="block px-4 py-2.5 text-xs {{ request()->routeIs('visimisi') ? 'bg-amber-50 text-amber-800 font-bold border-l-4 border-amber-600' : 'text-stone-700 hover:bg-amber-50 hover:text-amber-800' }} border-b border-amber-100">
                       Visi & Misi
                    </a>
                    <a href="{{ route('strukturorg') }}" wire:navigate 
                       class="block px-4 py-2.5 text-xs {{ request()->routeIs('strukturorg') ? 'bg-amber-50 text-amber-800 font-bold border-l-4 border-amber-600' : 'text-stone-700 hover:bg-amber-50 hover:text-amber-800' }}">
                       Struktur Organisasi
                    </a>
                </div>
            </div>

            <!-- KATALOG & BERITA -->
            {{-- Katalog & Arsip Naskah tinggal di aplikasi terpisah (subdomain).
                 TANPA wire:navigate — Livewire cuma bisa menavigasi halaman
                 internal, kalau dipasang di tautan eksternal navigasinya rusak. --}}
            <a href="{{ config('arsip.url') }}/koleksi"
               class="hover:text-amber-700 transition">
               Katalog
            </a>
            <a href="{{ config('arsip.url') }}/arsip"
               class="hover:text-amber-700 transition">
               Arsip Naskah
            </a>
            <a href="{{ route('berita') }}" wire:navigate 
               class="{{ request()->routeIs('berita*') ? 'text-amber-700 font-bold border-b-2 border-amber-600 pb-1' : 'hover:text-amber-700 transition' }}">
               Berita
            </a>

            <!-- DROPDOWN 2: LIVING MUSEUM -->
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown(event, 'menuMuseum')" 
                        class="flex items-center {{ request()->routeIs(['walangsuji', 'gosali']) ? 'text-amber-700 font-bold' : 'hover:text-amber-700' }} transition gap-1 focus:outline-none py-1">
                    Living Museum <span class="text-[9px]">▼</span>
                </button>
                <div id="menuMuseum" class="absolute left-0 mt-2 w-48 bg-white border border-amber-200 rounded-lg shadow-xl opacity-0 invisible -translate-y-2 transform transition-all duration-300 ease-out z-50 overflow-hidden text-left dropdown-list">
                    <a href="{{ route('walangsuji') }}" wire:navigate 
                       class="block px-4 py-2.5 text-xs {{ request()->routeIs('walangsuji') ? 'bg-amber-50 text-amber-800 font-bold border-l-4 border-amber-600' : 'text-stone-700 hover:bg-amber-50 hover:text-amber-800' }} border-b border-amber-100">
                       Walang Suji
                    </a>
                    <a href="{{ route('gosali') }}" wire:navigate 
                       class="block px-4 py-2.5 text-xs {{ request()->routeIs('gosali') ? 'bg-amber-50 text-amber-800 font-bold border-l-4 border-amber-600' : 'text-stone-700 hover:bg-amber-50 hover:text-amber-800' }}">
                       Gosali
                    </a>
                </div>
            </div>
        </nav>

        <!-- TOMBOL HAMBURGER MOBILE -->
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

    <!-- BACKDROP BLUR MOBILE -->
    <div id="mobile-menu-backdrop" class="hidden fixed inset-0 bg-stone-900/40 backdrop-blur-sm z-40 transition-opacity duration-300"></div>

    <!-- PANEL MENU MOBILE -->
    <div id="mobile-menu" class="hidden fixed top-20 left-0 right-0 md:hidden border-t border-amber-100 bg-white/95 px-6 py-4 space-y-3 text-sm font-medium text-stone-700 shadow-xl z-40 transition-all duration-300">
        <a href="{{ route('welcome') }}" wire:navigate 
           class="block {{ request()->routeIs('welcome') ? 'text-amber-700 font-bold' : 'hover:text-amber-700' }} py-1 transition">
           Beranda
        </a>

        <!-- DROPDOWN PROFIL MOBILE -->
        <details class="group my-1" {{ request()->routeIs(['sejarah', 'visimisi', 'strukturorg']) ? 'open' : '' }}>
            <summary class="flex items-center justify-between w-full text-sm font-medium {{ request()->routeIs(['sejarah', 'visimisi', 'strukturorg']) ? 'text-amber-700 font-bold' : 'text-stone-700 hover:text-amber-700' }} cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span>Profil</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
                <a href="{{ route('sejarah') }}" wire:navigate class="block text-xs {{ request()->routeIs('sejarah') ? 'text-amber-700 font-bold' : 'text-stone-500 hover:text-amber-700' }}">Sejarah</a>
                <a href="{{ route('visimisi') }}" wire:navigate class="block text-xs {{ request()->routeIs('visimisi') ? 'text-amber-700 font-bold' : 'text-stone-500 hover:text-amber-700' }}">Visi & Misi</a>
                <a href="{{ route('strukturorg') }}" wire:navigate class="block text-xs {{ request()->routeIs('strukturorg') ? 'text-amber-700 font-bold' : 'text-stone-500 hover:text-amber-700' }}">Struktur Organisasi</a>
            </div>
        </details>

        {{-- Tanpa wire:navigate: tautan ke aplikasi Arsip di subdomain lain. --}}
        <a href="{{ config('arsip.url') }}/koleksi" class="block hover:text-amber-700 py-1 transition">Katalog</a>
        <a href="{{ config('arsip.url') }}/arsip" class="block hover:text-amber-700 py-1 transition">Arsip Naskah</a>
        <a href="{{ route('berita') }}" wire:navigate class="block {{ request()->routeIs('berita*') ? 'text-amber-700 font-bold' : 'hover:text-amber-700' }} py-1 transition">Berita</a>

        <!-- DROPDOWN LIVING MUSEUM MOBILE -->
        <details class="group my-1" {{ request()->routeIs(['walangsuji', 'gosali']) ? 'open' : '' }}>
            <summary class="flex items-center justify-between w-full text-sm font-medium {{ request()->routeIs(['walangsuji', 'gosali']) ? 'text-amber-700 font-bold' : 'text-stone-700 hover:text-amber-700' }} cursor-pointer list-none py-1 [&::-webkit-details-marker]:hidden">
                <span>Living Museum</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-500 transition-transform duration-200 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div class="dropdown-content border-l border-amber-200 ml-1 pl-4 space-y-2.5 mt-2">
                <a href="{{ route('walangsuji') }}" wire:navigate class="block text-xs {{ request()->routeIs('walangsuji') ? 'text-amber-700 font-bold' : 'text-stone-500 hover:text-amber-700' }}">Walang Suji</a>
                <a href="{{ route('gosali') }}" wire:navigate class="block text-xs {{ request()->routeIs('gosali') ? 'text-amber-700 font-bold' : 'text-stone-500 hover:text-amber-700' }}">Gosali</a>
            </div>
        </details>
    </div>
</header>
