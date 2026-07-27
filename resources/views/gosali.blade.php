<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dokumentasi aktivitas penempaan keris dan seni kriya logam pusaka Gosali di Museum Talaga Manggung.">
    <link rel="icon" type="image/png" href="{{ asset('images/webicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">
    <title>Gosali - Living Museum | Museum Talaga Manggung</title>
    <!-- Menghubungkan aset CSS & JS lokal Laravel (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Menggunakan latar belakang krem muda hangat -->
<body class="bg-amber-50 text-stone-900 antialiased font-sans min-h-screen flex flex-col">

    <!-- 1. BILAH NAVIGASI (NAVBAR) MODULAR -->
    <x-site-navbar />

    <!-- 2. KONTEN UTAMA: GALERI (Gaya Google Images) -->
    <!-- PERBAIKAN: Mengubah background utama menjadi warna krem hangat (#fdfbf2) -->

<!-- Bagian Banner Latar Belakang Sepanjang Lebar Web Khusus Gosali -->
<div class="w-full mb-16 overflow-hidden aspect-[3/1] md:aspect-[21/9] lg:aspect-[3.5/1] bg-stone-900 shadow-sm">
    
    <!-- Gambar Latar Belakang Dinamis Khusus Halaman Gosali -->
    <!-- 🔴 Mengambil data khusus array key 'gosali' -->
    @if(isset($banners) && isset($banners['gosali']))
        <img src="{{ asset('storage/' . $banners['gosali']) }}" 
             alt="Header Banner Gosali" 
             class="w-full h-full object-cover">
    @else
        <!-- Gambar Default bertema tempaan logam, api, kerajinan senjata tradisional besi/baja jika admin belum unggah kustom -->
        <img src="https://unsplash.com" 
             alt="Default Banner Gosali" 
             class="w-full h-full object-cover opacity-80">
    @endif

</div>


<main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 py-8 bg-[#fdfbf2]">
    <div class="mb-8">
        <span class="text-xs font-bold tracking-widest text-amber-700 uppercase block mb-1">Living Museum</span>
        <h1 class="text-3xl font-serif font-bold text-stone-900 tracking-tight flex items-center gap-3">
            Gosali
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                🔴 Teater Digital
            </span>
        </h1>
        <p class="text-sm text-stone-600 mt-2 max-w-3xl">
            Saksikan rekonstruksi digital ritual, adat, dan warisan budaya adiluhung Kerajaan Talaga Manggung secara audiovisual interaktif.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-stone-950 rounded-2xl overflow-hidden shadow-xl aspect-video relative border border-amber-900/10">
                @if($videos->isNotEmpty())
                    @php
                        $firstVideo = $videos->first();
                        $videoSource = $firstVideo->video_file_path ? asset('storage/' . $firstVideo->video_file_path) : ($firstVideo->video_url ?? '');
                        $isYoutube = $videoSource && preg_match('#^(https?://)?(www\.)?(youtube\.com|youtu\.be)/#i', $videoSource);
                        $youtubeEmbedUrl = '';
                        if ($isYoutube) {
                            $youtubeEmbedUrl = preg_replace('#^(https?://)?(www\.)?(youtube\.com/watch\?v=|youtu\.be/)([\w-]+).*#i', 'https://www.youtube.com/embed/$4', $videoSource);
                        }
                        $posterSource = $firstVideo->thumbnail_path ? asset('storage/' . $firstVideo->thumbnail_path) : 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1200&q=80';
                    @endphp
                    @if($isYoutube)
                        <iframe id="mainMuseumPlayer" class="w-full h-full" src="{{ $youtubeEmbedUrl }}" title="{{ $firstVideo->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        <video id="mainMuseumPlayer" class="w-full h-full object-contain" controls poster="{{ $posterSource }}">
                            <source src="{{ $videoSource ?: 'https://www.w3schools.com/html/mov_bbb.mp4' }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutar video.
                        </video>
                    @endif
                @else
                    <div class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_top,_rgba(251,191,36,0.25),_transparent_60%)] p-6 text-center">
                        <div>
                            <div class="mb-3 text-4xl">🎞️</div>
                            <h2 class="text-lg font-semibold text-amber-100">Belum ada konten video</h2>
                            <p class="mt-2 text-sm text-stone-300">Konten akan muncul di sini setelah admin menambahkan video pertama.</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-xl p-6 border border-amber-200/60 shadow-sm">
                <div class="flex flex-wrap items-start justify-between gap-4 border-b border-stone-100 pb-4 mb-4">
                    <div>
                        <h2 id="currentVideoTitle" class="text-xl font-bold text-stone-900 font-serif">
                            {{ $videos->first()->title ?? 'Belum ada konten yang dipilih' }}
                        </h2>
                        <div class="flex items-center gap-4 text-xs text-stone-500 mt-1">
                            <span class="flex items-center gap-1">🕒 <span id="currentVideoDuration">{{ $videos->first()->duration ?? '00:00' }}</span></span>
                            <span>•</span>
                            <span class="flex items-center gap-1">👁️ 0 Dilihat</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-2">Sinopsis / Catatan Budaya</h3>
                    <p id="currentVideoDesc" class="text-sm text-stone-700 leading-relaxed">
                        {{ $videos->first()->description ?? 'Tambahkan sinopsis untuk menampilkan narasi yang muncul di halaman publik.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white rounded-xl border border-amber-200/60 shadow-sm overflow-hidden">
                <div class="bg-stone-900 text-amber-100 p-4 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-sm tracking-wide">Daftar Babak Dokumenter</h3>
                        <p class="text-xs text-stone-400">Koleksi Living Museum</p>
                    </div>
                    <span class="text-xs bg-amber-800/80 px-2.5 py-1 rounded font-mono">{{ $videos->count() }} Episode</span>
                </div>

                <div class="divide-y divide-stone-100 max-h-[480px] overflow-y-auto">
                    @forelse($videos as $video)
                        @php
                            $videoSource = $video->video_file_path ? asset('storage/' . $video->video_file_path) : ($video->video_url ?? '');
                            $posterSource = $video->thumbnail_path ? asset('storage/' . $video->thumbnail_path) : '';
                            $isYoutube = $videoSource && preg_match('#^(https?://)?(www\.)?(youtube\.com|youtu\.be)/#i', $videoSource);
                            $youtubeEmbedUrl = '';
                            if ($isYoutube) {
                                $youtubeEmbedUrl = preg_replace('#^(https?://)?(www\.)?(youtube\.com/watch\?v=|youtu\.be/)([\w-]+).*#i', 'https://www.youtube.com/embed/$4', $videoSource);
                            }
                        @endphp
                        <div onclick="playVideo(this, '{{ $videoSource }}', '{{ addslashes($video->title) }}', '{{ addslashes($video->description) }}', '{{ $video->duration }}', '{{ $posterSource }}', '{{ $youtubeEmbedUrl }}')"
                             class="w-full p-3.5 flex gap-3 cursor-pointer hover:bg-amber-50/50 transition items-start border-l-4 border-transparent group {{ $loop->first ? 'bg-amber-50/70 border-amber-600' : '' }}">
                            <div class="w-24 aspect-video bg-stone-800 rounded relative shrink-0 overflow-hidden border border-amber-200">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                    <span class="text-amber-400 text-xs">{{ $loop->first ? '▶️ Aktif' : '▶️' }}</span>
                                </div>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-xs {{ $loop->first ? 'font-bold text-amber-900' : 'font-semibold text-stone-800' }} line-clamp-2">{{ $video->title }}</h4>
                                <span class="text-[10px] {{ $loop->first ? 'text-amber-700' : 'text-stone-500' }} mt-1 block font-medium">{{ $video->duration }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-sm text-stone-500">
                            <div class="mb-2 text-2xl">📭</div>
                            <p class="font-medium text-stone-700">Belum ada data video untuk ditampilkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="p-4 bg-amber-100/40 rounded-xl border border-amber-200 text-xs text-amber-900">
                <p class="font-bold mb-1">💡 Info Tambahan:</p>
                <p class="text-stone-700 leading-relaxed">
                    Setiap klip video di atas menyajikan rekonstruksi visual berbasis arsip sejarah resmi Museum Talaga Manggung.
                </p>
            </div>
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


// ==========================================
// TAMBAHAN SCRIPT UNTUK PLAYLIST WALANG SUJI
// ==========================================
function playVideo(element, videoSrc, title, description, duration, posterSrc, youtubeEmbedUrl) {
    const player = document.getElementById('mainMuseumPlayer');
    const titleElem = document.getElementById('currentVideoTitle');
    const descElem = document.getElementById('currentVideoDesc');
    const durationElem = document.getElementById('currentVideoDuration');

    if (player) {
        if (youtubeEmbedUrl) {
            player.outerHTML = '<iframe id="mainMuseumPlayer" class="w-full h-full" src="' + youtubeEmbedUrl + '" title="' + title + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        } else {
            player.src = videoSrc || '';
            player.poster = posterSrc || 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1200&q=80';
            player.load();
            if (videoSrc) {
                player.play().catch(() => {});
            }
        }
    }

    if (titleElem) titleElem.innerText = title || 'Judul belum tersedia';
    if (descElem) descElem.innerText = description || 'Deskripsi belum tersedia';
    if (durationElem) durationElem.innerText = duration || '00:00';

    const allPlaylistItems = element.parentElement.children;
    Array.from(allPlaylistItems).forEach((item) => {
        item.classList.remove('bg-amber-50/70', 'border-amber-600');
        item.classList.add('border-transparent');

        const itemTitle = item.querySelector('h4');
        if (itemTitle) {
            itemTitle.classList.remove('font-bold', 'text-amber-900');
            itemTitle.classList.add('font-semibold', 'text-stone-800');
        }
    });

    element.classList.add('bg-amber-50/70', 'border-amber-600');
    element.classList.remove('border-transparent');

    const activeTitle = element.querySelector('h4');
    if (activeTitle) {
        activeTitle.classList.remove('font-semibold', 'text-stone-800');
        activeTitle.classList.add('font-bold', 'text-amber-900');
    }
}

</script>
