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
        <!-- Header Banner Cinematic 8K Ultra High Res -->
        <img src="{{ asset('images/banners/gosali_banner.jpg') }}" 
             alt="Default Banner Gosali" 
             class="w-full h-full object-cover opacity-90">
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
                        $rawVideoPath = $firstVideo->video_file_path;
                        $videoSource = $rawVideoPath 
                            ? (\Illuminate\Support\Str::startsWith($rawVideoPath, 'http') ? $rawVideoPath : (\Illuminate\Support\Str::startsWith($rawVideoPath, 'storage/') ? asset($rawVideoPath) : asset('storage/' . $rawVideoPath))) 
                            : ($firstVideo->video_url ?? '');

                        $rawPosterPath = $firstVideo->thumbnail_path;
                        $posterSource = $rawPosterPath 
                            ? (\Illuminate\Support\Str::startsWith($rawPosterPath, 'http') ? $rawPosterPath : (\Illuminate\Support\Str::startsWith($rawPosterPath, 'images/') ? asset($rawPosterPath) : (\Illuminate\Support\Str::startsWith($rawPosterPath, 'storage/') ? asset($rawPosterPath) : asset('storage/' . $rawPosterPath)))) 
                            : 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1200&q=80';

                        $isYoutube = $videoSource && preg_match('#^(https?://)?(www\.)?(youtube\.com|youtu\.be)/#i', $videoSource);
                        $youtubeEmbedUrl = '';
                        if ($isYoutube) {
                            $youtubeEmbedUrl = preg_replace('#^(https?://)?(www\.)?(youtube\.com/watch\?v=|youtu\.be/)([\w-]+).*#i', 'https://www.youtube.com/embed/$4', $videoSource);
                        }
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
                    <!-- Tombol Interaksi Unduhan & Mode Teater -->
                    <div class="flex flex-wrap items-center gap-2">
                        <button onclick="openTheaterModal()" class="bg-amber-700 hover:bg-amber-800 text-white text-xs font-semibold px-4 py-2 rounded-lg transition inline-flex items-center gap-1.5 shadow-sm">
                            🎬 Mode Teater Bioskop
                        </button>
                        <button id="btnDownloadPdf" onclick="downloadCurrentPdf()" class="bg-amber-100 hover:bg-amber-200 text-amber-900 text-xs font-semibold px-4 py-2 rounded-lg transition inline-flex items-center gap-1.5">
                            📥 Unduh Brosur (PDF)
                        </button>
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
                            $rawVPath = $video->video_file_path;
                            $vSource = $rawVPath 
                                ? (\Illuminate\Support\Str::startsWith($rawVPath, 'http') ? $rawVPath : (\Illuminate\Support\Str::startsWith($rawVPath, 'storage/') ? asset($rawVPath) : asset('storage/' . $rawVPath))) 
                                : ($video->video_url ?? '');

                            $rawPPath = $video->thumbnail_path;
                            $pSource = $rawPPath 
                                ? (\Illuminate\Support\Str::startsWith($rawPPath, 'http') ? $rawPPath : (\Illuminate\Support\Str::startsWith($rawPPath, 'images/') ? asset($rawPPath) : (\Illuminate\Support\Str::startsWith($rawPPath, 'storage/') ? asset($rawPPath) : asset('storage/' . $rawPPath)))) 
                                : '';

                            $isYt = $vSource && preg_match('#^(https?://)?(www\.)?(youtube\.com|youtu\.be)/#i', $vSource);
                            $ytEmbed = '';
                            if ($isYt) {
                                $ytEmbed = preg_replace('#^(https?://)?(www\.)?(youtube\.com/watch\?v=|youtu\.be/)([\w-]+).*#i', 'https://www.youtube.com/embed/$4', $vSource);
                            }

                            $pdfUrl = $video->guide_pdf_path ? asset('storage/' . $video->guide_pdf_path) : '';
                        @endphp
                        <div data-video-src="{{ $vSource }}"
                             data-title="{{ $video->title }}"
                             data-description="{{ $video->description }}"
                             data-duration="{{ $video->duration ?? '00:00' }}"
                             data-poster-src="{{ $pSource }}"
                             data-youtube-embed="{{ $ytEmbed }}"
                             data-guide-pdf="{{ $pdfUrl }}"
                             onclick="selectPlaylistItem(this)"
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

<!-- MODAL TEATER LIGHTBOX CINEMATIC -->
<div id="theaterModal" class="fixed inset-0 z-50 hidden bg-stone-950/95 backdrop-blur-md p-4 md:p-8 flex flex-col justify-center items-center">
    <div class="w-full max-w-5xl flex items-center justify-between mb-4 text-white">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-amber-400 block mb-0.5">🎬 Mode Teater Bioskop</span>
            <h3 id="modalVideoTitle" class="text-lg md:text-xl font-bold font-serif text-white line-clamp-1"></h3>
        </div>
        <button onclick="closeTheaterModal()" class="h-10 w-10 rounded-full bg-stone-800 hover:bg-amber-600 text-white flex items-center justify-center transition font-bold text-lg shadow-lg border border-stone-700">
            ✕
        </button>
    </div>
    <div class="w-full max-w-5xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl border border-stone-800 relative">
        <div id="modalPlayerContainer" class="w-full h-full"></div>
    </div>
    <div class="w-full max-w-5xl mt-4 text-xs text-stone-400 text-center">
        Tekan <kbd class="px-2 py-0.5 bg-stone-800 border border-stone-700 rounded text-stone-200 font-mono">ESC</kbd> atau klik tombol ✕ di kanan atas untuk kembali
    </div>
</div>

<x-site-footer />

<script>
    // ==========================================
    // 1. FUNGSI UTAMA DROPDOWN DESKTOP
    // ==========================================
    function toggleDropdown(event, menuId) {
        event.stopPropagation();

        const targetMenu = document.getElementById(menuId);
        const allMenus = document.querySelectorAll('.dropdown-list');

        allMenus.forEach(menu => {
            if (menu !== targetMenu) {
                menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
            }
        });

        if (targetMenu) {
            targetMenu.classList.toggle('opacity-0');
            targetMenu.classList.toggle('invisible');
            targetMenu.classList.toggle('-translate-y-2');
            targetMenu.classList.toggle('opacity-100');
            targetMenu.classList.toggle('visible');
            targetMenu.classList.toggle('translate-y-0');
        }
    }

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

        if (!toggleBtn || !backdrop || !menu) return;

        function closeMenu() {
            menu.classList.add('hidden');
            backdrop.classList.add('hidden');
            if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
        }

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

        toggleBtn.replaceWith(toggleBtn.cloneNode(true));
        backdrop.replaceWith(backdrop.cloneNode(true));

        const cleanToggleBtn = document.getElementById('mobile-menu-button');
        const cleanBackdrop = document.getElementById('mobile-menu-backdrop');

        cleanToggleBtn.addEventListener('click', toggleMenu);
        cleanBackdrop.addEventListener('click', closeMenu);
    }

    document.addEventListener('DOMContentLoaded', initAppNavigation);
    document.addEventListener('livewire:navigated', initAppNavigation);

    // ==========================================
    // 3. TEATER LIGHTBOX & PLAYER INTERAKTIF
    // ==========================================
    let currentActiveVideo = {};

    function selectPlaylistItem(element) {
        if (!element) return;

        const videoSrc = element.getAttribute('data-video-src') || '';
        const title = element.getAttribute('data-title') || 'Judul belum tersedia';
        const description = element.getAttribute('data-description') || 'Deskripsi belum tersedia';
        const duration = element.getAttribute('data-duration') || '00:00';
        const posterSrc = element.getAttribute('data-poster-src') || '';
        const youtubeEmbedUrl = element.getAttribute('data-youtube-embed') || '';
        const guidePdf = element.getAttribute('data-guide-pdf') || '';

        currentActiveVideo = { videoSrc, title, posterSrc, youtubeEmbedUrl, guidePdf };

        const playerContainer = document.querySelector('.lg\\:col-span-2 .aspect-video');
        const titleElem = document.getElementById('currentVideoTitle');
        const descElem = document.getElementById('currentVideoDesc');
        const durationElem = document.getElementById('currentVideoDuration');

        if (playerContainer) {
            if (youtubeEmbedUrl) {
                playerContainer.innerHTML = '<iframe id="mainMuseumPlayer" class="w-full h-full" src="' + youtubeEmbedUrl + '?autoplay=1" title="' + title.replace(/"/g, '&quot;') + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            } else {
                playerContainer.innerHTML = '<video id="mainMuseumPlayer" class="w-full h-full object-contain" controls autoplay poster="' + posterSrc + '"><source src="' + videoSrc + '" type="video/mp4">Browser Anda tidak mendukung pemutar video.</video>';
            }
        }

        if (titleElem) titleElem.innerText = title;
        if (descElem) descElem.innerText = description;
        if (durationElem) durationElem.innerText = duration;

        const allPlaylistItems = element.parentElement.children;
        Array.from(allPlaylistItems).forEach((item) => {
            item.classList.remove('bg-amber-50/70', 'border-amber-600');
            item.classList.add('border-transparent');

            const itemTitle = item.querySelector('h4');
            if (itemTitle) {
                itemTitle.classList.remove('font-bold', 'text-amber-900');
                itemTitle.classList.add('font-semibold', 'text-stone-800');
            }

            const badgeContainer = item.querySelector('.aspect-video > div');
            if (badgeContainer) {
                badgeContainer.innerHTML = '<span class="text-amber-400 text-xs">▶️</span>';
            }
        });

        element.classList.add('bg-amber-50/70', 'border-amber-600');
        element.classList.remove('border-transparent');

        const activeTitle = element.querySelector('h4');
        if (activeTitle) {
            activeTitle.classList.remove('font-semibold', 'text-stone-800');
            activeTitle.classList.add('font-bold', 'text-amber-900');
        }

        const activeBadge = element.querySelector('.aspect-video > div');
        if (activeBadge) {
            activeBadge.innerHTML = '<span class="text-amber-400 text-xs">▶️ Aktif</span>';
        }
    }

    function downloadCurrentPdf() {
        if (currentActiveVideo && currentActiveVideo.guidePdf) {
            window.open(currentActiveVideo.guidePdf, '_blank');
        } else {
            alert('Brosur / buku panduan PDF belum diunggah untuk babak ini.');
        }
    }

    function openTheaterModal() {
        const modal = document.getElementById('theaterModal');
        const modalTitle = document.getElementById('modalVideoTitle');
        const modalPlayerContainer = document.getElementById('modalPlayerContainer');

        if (!modal || !modalPlayerContainer) return;

        if (modalTitle) modalTitle.innerText = currentActiveVideo.title || 'Mode Teater';

        // Stop inline player
        const inlinePlayer = document.getElementById('mainMuseumPlayer');
        if (inlinePlayer && typeof inlinePlayer.pause === 'function') {
            inlinePlayer.pause();
        }

        if (currentActiveVideo.youtubeEmbedUrl) {
            modalPlayerContainer.innerHTML = '<iframe class="w-full h-full" src="' + currentActiveVideo.youtubeEmbedUrl + '?autoplay=1" title="' + (currentActiveVideo.title || '').replace(/"/g, '&quot;') + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        } else {
            modalPlayerContainer.innerHTML = '<video class="w-full h-full object-contain" controls autoplay poster="' + (currentActiveVideo.posterSrc || '') + '"><source src="' + (currentActiveVideo.videoSrc || '') + '" type="video/mp4">Browser Anda tidak mendukung pemutar video.</video>';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeTheaterModal() {
        const modal = document.getElementById('theaterModal');
        const modalPlayerContainer = document.getElementById('modalPlayerContainer');

        if (!modal) return;

        if (modalPlayerContainer) {
            modalPlayerContainer.innerHTML = '';
        }

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function initInteractivePlayer() {
        const firstItem = document.querySelector('[data-video-src]');
        if (firstItem) {
            const videoSrc = firstItem.getAttribute('data-video-src') || '';
            const title = firstItem.getAttribute('data-title') || '';
            const posterSrc = firstItem.getAttribute('data-poster-src') || '';
            const youtubeEmbedUrl = firstItem.getAttribute('data-youtube-embed') || '';
            const guidePdf = firstItem.getAttribute('data-guide-pdf') || '';

            currentActiveVideo = { videoSrc, title, posterSrc, youtubeEmbedUrl, guidePdf };
        }
    }

    document.addEventListener('DOMContentLoaded', initInteractivePlayer);
    document.addEventListener('livewire:navigated', initInteractivePlayer);

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeTheaterModal();
        }
    });
</script>
