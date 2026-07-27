<x-app-layout>
    <div class="min-h-screen bg-[#fdfbf2] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800 shadow-sm">
                    <span class="font-semibold">Berhasil!</span> {{ session('success') }}
                </div>
            @endif

            <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <span class="mb-1 block text-xs font-bold uppercase tracking-[0.25em] text-amber-700">Panel Admin / Living Museum</span>
                    <h1 class="flex items-center gap-3 font-serif text-3xl font-bold tracking-tight text-stone-900">
                        Walang Suji
                        <span class="rounded-full border border-amber-200 bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800">
                            🔴 Teater Digital
                        </span>
                    </h1>
                    <p class="mt-2 max-w-3xl text-sm text-stone-600">
                        Kelola urutan konten dokumenter, sinopsis babak, dan lampiran panduan agar tampilan publik tetap konsisten dengan pengalaman teater digital.
                    </p>
                </div>



                <div class="flex flex-wrap gap-2">
                    <button type="button" onclick="openAdminModal('modalTambahVideo')" class="rounded-lg bg-amber-700 px-4 py-2.5 text-xs font-bold uppercase tracking-wide text-white shadow-sm transition hover:bg-amber-800">
                        ➕ Tambah Konten
                    </button>
                    <a href="{{ route('walangsuji') }}" class="rounded-lg border border-amber-200 bg-white px-4 py-2.5 text-xs font-semibold text-amber-800 transition hover:bg-amber-50">
                        Lihat Halaman Publik
                    </a>
                </div>
            </div>

            <!-- Bagian Banner Latar Belakang Sepanjang Lebar Web Khusus Struktur Organisasi -->
<!-- Bagian Editor Header Dinamis Khusus Admin Walang Suji -->
<div class="mb-8 p-6 bg-white border border-stone-200/80 rounded-2xl shadow-sm">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        
        <!-- Informasi & Pratinjau Gambar Saat Ini -->
        <div class="flex items-start sm:items-center gap-4 flex-1">
            <div class="shrink-0 relative group">
                <!-- Membaca variabel array global $banners dengan indeks 'walangsuji' -->
                @if(isset($banners) && isset($banners['walangsuji']))
                    <img src="{{ asset('storage/' . $banners['walangsuji']) }}" 
                         alt="Header Walang Suji Saat Ini" 
                         class="w-32 h-20 object-cover rounded-xl border border-stone-200 shadow-sm bg-stone-50">
                @else
                    <div class="w-32 h-20 bg-stone-100 rounded-xl border border-dashed border-stone-300 flex flex-col items-center justify-center text-center p-2">
                        <svg class="h-5 w-5 text-stone-400 mb-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H2.25A1.5 1.5 0 00.75 6v12.75a1.5 1.5 0 001.5 1.5z" />
                        </svg>
                        <span class="text-[9px] font-medium text-stone-400">Gambar Default</span>
                    </div>
                @endif
            </div>
            <div>
                <h3 class="text-sm font-bold text-stone-800 flex items-center gap-1.5">
                    <span>Banner Header Walang Suji</span>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-amber-50 text-amber-800 border border-amber-200">Kustom</span>
                </h3>
                <p class="text-xs text-stone-500 mt-0.5 max-w-md leading-relaxed">
                    Gambar ini akan muncul sebagai latar belakang judul utama pada halaman informasi / dokumentasi Walang Suji publik.
                </p>
            </div>
        </div>

        <!-- Form Pemilihan & Aksi Simpan untuk Admin Walang Suji -->
        <form action="{{ route('admin.setting.update-header') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0">
            @csrf
            @method('PUT')
            
            <!-- 🔴 PENANDA HALAMAN: Diatur khusus ke 'walangsuji' -->
            <input type="hidden" name="halaman" value="walangsuji">
            
            <div class="relative">
                <input type="file" name="banner_image" id="banner_walangsuji_input" accept="image/*" required
                       class="block w-full sm:w-64 text-xs text-stone-500 border border-stone-200 rounded-xl bg-stone-50/50 file:mr-3 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:text-xs file:font-bold file:bg-amber-600 file:text-white hover:file:bg-amber-700 cursor-pointer focus:outline-none focus:ring-1 focus:ring-amber-500 transition">
            </div>

            <button type="submit" class="inline-flex items-center justify-center space-x-2 bg-stone-800 hover:bg-stone-900 text-white font-bold text-xs px-5 py-2.5 h-[38px] rounded-xl transition duration-150 shadow-sm">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Perbarui Banner Walang Suji</span>
            </button>
        </form>

    </div>
    
    <!-- Bagian Info Validasi Tambahan & Notifikasi Eror / Sukses -->
    <div class="mt-3 pt-3 border-t border-stone-100 flex flex-col sm:flex-row sm:items-center sm:justify-between text-[11px] gap-2">
        <span class="text-stone-400">Rekomendasi rasio lebar 3:1 (Maksimal 2MB, format .jpg, .png, .webp).</span>
        
        @if(session('success_header'))
            <span class="text-emerald-600 font-semibold bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">{{ session('success_header') }}</span>
        @endif

        @error('banner_image')
            <span class="text-red-600 font-semibold bg-red-50 px-2.5 py-1 rounded-md border border-red-200">{{ $message }}</span>
        @enderror
    </div>
</div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-2">
                    <div class="relative overflow-hidden rounded-2xl border border-amber-900/10 bg-stone-950 shadow-xl aspect-video">
                        @if($videos->isNotEmpty())
                            @php
                                $firstVideo = $videos->first();
                                $videoSource = $firstVideo->video_file_path ? asset('storage/' . $firstVideo->video_file_path) : ($firstVideo->video_url ?? '');
                                $isYoutube = $videoSource && preg_match('#^(https?://)?(www\.)?(youtube\.com|youtu\.be)/#i', $videoSource);
                                $youtubeEmbedUrl = '';
                                if ($isYoutube) {
                                    $youtubeEmbedUrl = preg_replace('#^(https?://)?(www\.)?(youtube\.com/watch\?v=|youtu\.be/)([\w-]+).*#i', 'https://www.youtube.com/embed/$4', $videoSource);
                                }
                            @endphp
                            @if($isYoutube)
                                <iframe id="mainMuseumPlayer" class="h-full w-full" src="{{ $youtubeEmbedUrl }}" title="{{ $firstVideo->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <video id="mainMuseumPlayer" class="h-full w-full object-contain" controls poster="{{ $firstVideo->thumbnail_path ? asset('storage/' . $firstVideo->thumbnail_path) : 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1200&q=80' }}">
                                    <source src="{{ $videoSource ?: 'https://www.w3schools.com/html/mov_bbb.mp4' }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutar video.
                                </video>
                            @endif
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_top,_rgba(251,191,36,0.25),_transparent_60%)] p-6 text-center">
                                <div>
                                    <div class="mb-3 text-4xl">🎞️</div>
                                    <h2 class="text-lg font-semibold text-amber-100">Belum ada konten video</h2>
                                    <p class="mt-2 text-sm text-stone-300">Tambahkan item pertama untuk menampilkan pemutar dan playlist yang serupa dengan halaman publik.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="rounded-xl border border-amber-200/60 bg-white p-6 shadow-sm">
                        <div class="flex flex-wrap items-start justify-between gap-4 border-b border-stone-100 pb-4">
                            <div>
                                <h2 id="currentVideoTitle" class="font-serif text-xl font-bold text-stone-900">
                                    {{ optional($videos->first())->title ?? 'Belum ada konten yang dipilih' }}
                                </h2>
                                <div class="mt-2 flex flex-wrap items-center gap-3 text-xs text-stone-500">
                                    <span class="flex items-center gap-1">🕒 <span id="currentVideoDuration">{{ optional($videos->first())->duration ?? '00:00' }}</span></span>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" class="rounded-lg bg-amber-100 px-3.5 py-2 text-xs font-semibold text-amber-900 transition hover:bg-amber-200">
                                    📥 Unduh Panduan
                                </button>
                                <button type="button" onclick="openAdminModal('modalTambahVideo')" class="rounded-lg border border-stone-200 px-3.5 py-2 text-xs font-semibold text-stone-700 transition hover:bg-stone-50">
                                    ✏️ Ubah Konten
                                </button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="mb-2 text-xs font-bold uppercase tracking-wider text-stone-400">Sinopsis / Catatan Budaya</h3>
                            <p id="currentVideoDesc" class="text-sm leading-relaxed text-stone-700">
                                {{ optional($videos->first())->description ?? 'Tambahkan sinopsis untuk menampilkan narasi yang muncul di halaman publik.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="overflow-hidden rounded-xl border border-amber-200/60 bg-white shadow-sm">
                        <div class="flex items-center justify-between bg-stone-900 p-4 text-amber-100">
                            <div>
                                <h3 class="text-sm font-bold tracking-wide">Daftar Babak Dokumenter</h3>
                                <p class="text-xs text-stone-400">Urutan konten yang tampil di publik</p>
                            </div>
                            <span class="rounded font-mono bg-amber-800/80 px-2.5 py-1 text-xs">
                                {{ $videos->count() }} Episode
                            </span>
                        </div>

                        <div id="playlistList" class="max-h-[520px] divide-y divide-stone-100 overflow-y-auto">
                            @forelse($videos as $video)
                                @php
                                    $videoSource = $video->video_file_path 
                                        ? (\Illuminate\Support\Str::startsWith($video->video_file_path, 'http') ? $video->video_file_path : (\Illuminate\Support\Str::startsWith($video->video_file_path, 'storage/') ? asset($video->video_file_path) : asset('storage/' . $video->video_file_path))) 
                                        : ($video->video_url ?? '');
                                    $posterSource = $video->thumbnail_path 
                                        ? (\Illuminate\Support\Str::startsWith($video->thumbnail_path, 'http') ? $video->thumbnail_path : (\Illuminate\Support\Str::startsWith($video->thumbnail_path, 'images/') ? asset($video->thumbnail_path) : (\Illuminate\Support\Str::startsWith($video->thumbnail_path, 'storage/') ? asset($video->thumbnail_path) : asset('storage/' . $video->thumbnail_path)))) 
                                        : '';
                                @endphp
                                <div
                                    data-id="{{ $video->id }}"
                                    draggable="true"
                                    ondragstart="dragStart(event, '{{ $video->id }}')"
                                    ondragover="dragOver(event)"
                                    ondrop="dropItem(event, '{{ $video->id }}')"
                                    onclick="playVideo(this, '{{ $videoSource }}', {{ json_encode($video->title ?? '') }}, {{ json_encode($video->description ?? '') }}, {{ json_encode($video->duration ?? '') }}, '{{ $posterSource }}')"
                                    class="flex cursor-grab items-start gap-3 p-3.5 transition hover:bg-amber-50/60"
                                >
                                    <div class="h-20 w-24 shrink-0 overflow-hidden rounded bg-stone-800">
                                        @if($video->thumbnail_path)
                                            <img src="{{ $posterSource }}" alt="{{ $video->title }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full items-center justify-center bg-black/30 text-[10px] font-semibold uppercase tracking-wide text-amber-200">
                                                MP4
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-start justify-between gap-2">
                                            <h4 class="line-clamp-2 text-xs font-semibold text-stone-800">{{ $video->title }}</h4>
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.walangsuji.edit', $video->id) }}" class="text-[10px] font-semibold text-amber-700">✏️</a>
                                                <form action="{{ route('admin.walangsuji.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Hapus video ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-[10px] font-semibold text-red-700">🗑️</button>
                                                </form>
                                            </div>
                                        </div>
                                        <span class="mt-1 block text-[10px] text-stone-500">{{ $video->duration }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-center text-sm text-stone-500">
                                    <div class="mb-2 text-2xl">📭</div>
                                    <p class="font-medium text-stone-700">Belum ada data video yang ditambahkan.</p>
                                    <p class="mt-1 text-xs text-stone-500">Klik tombol tambah konten untuk memulai.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="rounded-xl border border-amber-200 bg-amber-100/40 p-4 text-xs text-amber-900">
                        <p class="mb-1 font-bold">💡 Catatan Admin</p>
                        <p class="leading-relaxed text-stone-700">
                            Susun konten dari yang paling penting terlebih dahulu agar urutan tampil di halaman publik tetap menarik dan informatif.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalTambahVideo" class="fixed inset-0 z-50 flex items-center justify-center bg-stone-900/60 p-4 opacity-0 invisible transition-all duration-300 backdrop-blur-sm">
        <div class="w-full max-w-lg scale-95 rounded-xl border border-amber-200 bg-white shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between bg-stone-900 px-6 py-4 text-amber-100">
                <h3 class="text-sm font-bold tracking-wide">Formulir Tambah Video Dokumenter</h3>
                <button type="button" onclick="closeAdminModal('modalTambahVideo')" class="text-base text-stone-400 transition hover:text-white">✕</button>
            </div>

            <form action="{{ route('admin.walangsuji.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 p-6 text-xs text-stone-700">
                @csrf

                <div>
                    <label class="mb-1 block font-bold uppercase tracking-wider text-stone-600">Judul Babak Video</label>
                    <input type="text" name="title" placeholder="Contoh: 1. Asal-Usul Istilah Walang Suji" class="w-full rounded-lg border border-stone-200 bg-stone-50/50 px-3 py-2 focus:border-amber-600 focus:outline-none" required />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block font-bold uppercase tracking-wider text-stone-600">Durasi Video (MM:DD)</label>
                        <input type="text" name="duration" placeholder="Contoh: 12:04" class="w-full rounded-lg border border-stone-200 bg-stone-50/50 px-3 py-2 focus:border-amber-600 focus:outline-none" required />
                    </div>
                    <div>
                        <label class="mb-1 block font-bold uppercase tracking-wider text-stone-600">Urutan Putar</label>
                        <input type="number" name="sort_order" placeholder="Contoh: 1" class="w-full rounded-lg border border-stone-200 bg-stone-50/50 px-3 py-2 focus:border-amber-600 focus:outline-none" required />
                    </div>
                </div>

                <div class="rounded-xl border border-stone-200 bg-stone-50/70 p-4">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-stone-600">Pilih Sumber Video Utama:</label>
                    
                    <div class="flex rounded-lg bg-stone-200/80 p-1 mb-4 text-xs font-bold">
                        <button type="button" id="modal_tab_youtube" onclick="switchModalVideoSource('youtube')" class="flex-1 rounded-md py-2 text-center transition shadow-sm bg-white text-amber-900 font-bold">
                            ▶️ Link YouTube
                        </button>
                        <button type="button" id="modal_tab_file" onclick="switchModalVideoSource('file')" class="flex-1 rounded-md py-2 text-center transition text-stone-600 hover:text-stone-900 font-medium">
                            📁 Upload MP4 Laptop
                        </button>
                    </div>

                    <!-- Mode 1: YouTube -->
                    <div id="modal_wrapper_youtube">
                        <label class="mb-1 block font-semibold text-stone-700 text-xs">URL Video YouTube</label>
                        <input type="url" name="video_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full rounded-lg border border-stone-200 bg-white px-3 py-2 text-xs focus:border-amber-600 focus:outline-none" />
                        <p class="mt-1 text-[11px] text-stone-400">Masukkan link YouTube yang ingin diputar di player publik.</p>
                    </div>

                    <!-- Mode 2: MP4 File Upload -->
                    <div id="modal_wrapper_file" class="hidden">
                        <label class="mb-1 block font-semibold text-stone-700 text-xs">Pilih File Video MP4 (Max 100MB)</label>
                        <input type="file" name="video_file" accept="video/mp4,video/webm,video/quicktime" class="w-full rounded-lg border border-stone-200 bg-white px-3 py-2 text-xs" />
                        <p class="mt-1 text-[11px] text-stone-400">File MP4 akan langsung diunggah dan dijadikan video utama.</p>
                    </div>

                    <input type="hidden" name="source_type" id="modal_input_source_type" value="youtube" />
                </div>

                <div>
                    <label class="mb-1 block font-bold uppercase tracking-wider text-stone-600">Thumbnail (JPG/PNG/WebP - Opsional)</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-stone-500 file:mr-4 file:rounded-md file:border-0 file:bg-amber-50 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-amber-800 hover:file:bg-amber-100" />
                </div>

                <div>
                    <label class="mb-1 block font-bold uppercase tracking-wider text-stone-600">Sinopsis / Catatan Narasi</label>
                    <textarea name="description" rows="3" placeholder="Tuliskan ulasan narasi atau ringkasan sejarah singkat mengenai babak ini..." class="w-full rounded-lg border border-stone-200 bg-stone-50/50 px-3 py-2 focus:border-amber-600 focus:outline-none" required></textarea>
                </div>

                <div>
                    <label class="mb-1 block font-bold uppercase tracking-wider text-stone-600">Lampiran Buku Panduan (PDF - Opsional)</label>
                    <input type="file" name="guide_pdf" accept="application/pdf" class="w-full text-stone-500 file:mr-4 file:rounded-md file:border-0 file:bg-amber-50 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-amber-800 hover:file:bg-amber-100" />
                </div>

                <div class="flex items-center justify-end gap-2 border-t border-stone-100 pt-3">
                    <button type="button" onclick="closeAdminModal('modalTambahVideo')" class="rounded-lg border border-stone-200 px-4 py-2 font-medium text-stone-500 transition hover:bg-stone-50">Batal</button>
                    <button type="submit" class="rounded-lg bg-amber-700 px-4 py-2 font-bold text-white shadow-sm transition hover:bg-amber-800">Simpan Konten</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchModalVideoSource(type) {
            const tabYt = document.getElementById('modal_tab_youtube');
            const tabFile = document.getElementById('modal_tab_file');
            const wrapYt = document.getElementById('modal_wrapper_youtube');
            const wrapFile = document.getElementById('modal_wrapper_file');
            const sourceType = document.getElementById('modal_input_source_type');

            if (sourceType) sourceType.value = type;

            if (type === 'youtube') {
                if (tabYt) tabYt.className = 'flex-1 rounded-md py-2 text-center transition shadow-sm bg-white text-amber-900 font-bold';
                if (tabFile) tabFile.className = 'flex-1 rounded-md py-2 text-center transition text-stone-600 hover:text-stone-900 font-medium';
                if (wrapYt) wrapYt.classList.remove('hidden');
                if (wrapFile) wrapFile.classList.add('hidden');
            } else {
                if (tabFile) tabFile.className = 'flex-1 rounded-md py-2 text-center transition shadow-sm bg-white text-amber-900 font-bold';
                if (tabYt) tabYt.className = 'flex-1 rounded-md py-2 text-center transition text-stone-600 hover:text-stone-900 font-medium';
                if (wrapFile) wrapFile.classList.remove('hidden');
                if (wrapYt) wrapYt.classList.add('hidden');
            }
        }

        let draggedId = null;

        function openAdminModal(modalId) {
            const modal = document.getElementById(modalId);
            const modalBox = modal.querySelector('div');

            modal.classList.remove('opacity-0', 'invisible');
            modalBox.classList.remove('scale-95');
            modalBox.classList.add('scale-100');
        }

        function closeAdminModal(modalId) {
            const modal = document.getElementById(modalId);
            const modalBox = modal.querySelector('div');

            modal.classList.add('opacity-0', 'invisible');
            modalBox.classList.remove('scale-100');
            modalBox.classList.add('scale-95');
        }

        function playVideo(element, videoSrc, title, description, duration, posterSrc) {
            const player = document.getElementById('mainMuseumPlayer');
            const titleElem = document.getElementById('currentVideoTitle');
            const descElem = document.getElementById('currentVideoDesc');
            const durationElem = document.getElementById('currentVideoDuration');

            if (player) {
                player.src = videoSrc || '';
                player.poster = posterSrc || '';
                player.load();
                if (videoSrc) {
                    player.play().catch(() => {});
                }
            }

            if (titleElem) titleElem.innerText = title || 'Judul belum tersedia';
            if (descElem) descElem.innerText = description || 'Deskripsi belum tersedia';
            if (durationElem) durationElem.innerText = duration || '00:00';

            const items = element.parentElement.children;
            Array.from(items).forEach((item) => {
                item.classList.remove('bg-amber-50/70');
                const titleText = item.querySelector('h4');
                if (titleText) {
                    titleText.classList.remove('text-amber-900');
                    titleText.classList.add('text-stone-800');
                }
            });

            element.classList.add('bg-amber-50/70');
            const activeTitle = element.querySelector('h4');
            if (activeTitle) {
                activeTitle.classList.remove('text-stone-800');
                activeTitle.classList.add('text-amber-900');
            }
        }

        function dragStart(event, id) {
            draggedId = id;
            event.dataTransfer.effectAllowed = 'move';
        }

        function dragOver(event) {
            event.preventDefault();
            event.dataTransfer.dropEffect = 'move';
        }

        function dropItem(event, targetId) {
            event.preventDefault();
            if (!draggedId || draggedId === targetId) {
                return;
            }

            const playlist = document.getElementById('playlistList');
            const items = Array.from(playlist.children);
            const draggedIndex = items.findIndex((item) => item.getAttribute('data-id') === draggedId);
            const targetIndex = items.findIndex((item) => item.getAttribute('data-id') === targetId);

            if (draggedIndex < 0 || targetIndex < 0) {
                return;
            }

            const [movedItem] = items.splice(draggedIndex, 1);
            items.splice(targetIndex, 0, movedItem);
            playlist.replaceChildren(...items);

            const ids = items.map((item) => item.getAttribute('data-id'));
            fetch('{{ route('admin.walangsuji.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ids })
            }).catch(() => {});
        }
    </script>
</x-app-layout>
