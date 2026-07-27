<x-app-layout>
    <!-- Tambahkan aset AOS jika layout utama (app-layout) Anda belum memuatnya -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    <!-- Pembungkus Konten Utama dengan Latar Belakang Krem Khas Museum -->
    <div class="min-h-screen bg-[#fdfbf2] py-12 font-sans">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <!-- Bagian Judul Dashboard -->
            <div data-aos="fade-down" data-aos-duration="800" class="mb-10 flex flex-col items-start">
                <span class="bg-amber-100/70 border border-amber-200 text-amber-800 text-[10px] md:text-xs font-bold tracking-wider px-4 py-1.5 rounded-full mb-4 uppercase">
                    Panel Manajemen Sistem
                </span>
                <h1 class="text-3xl md:text-4xl font-black text-amber-700 tracking-tight leading-tight">
                    {{ __('Selamat Datang, Admin') }}
                </h1>
                <p class="text-sm text-stone-500 mt-2">
                    Gunakan ruang kerja ini untuk memantau data operasional dan mengelola arsip kebudayaan.
                </p>
            </div>

            <!-- Konten Kartu Utama -->
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" 
                 class="bg-white border border-amber-200/60 overflow-hidden shadow-sm rounded-2xl p-8 hover:shadow-md transition-shadow duration-300 mb-8">
                
                <!-- Indikator Berhasil Masuk Bergaya Minimalis -->
                <div class="flex items-center space-x-4 border-b border-stone-100 pb-6 mb-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 border border-amber-200 text-amber-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-stone-800">Status Autentikasi</h3>
                        <p class="text-xs text-stone-500">{{ __("Sesi Anda saat ini aktif dan terenkripsi dengan aman.") }}</p>
                    </div>
                </div>

                <!-- GRAFIK DATA OPERASIONAL -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 font-sans">
                    <!-- Grafik 1: Tren Pengunjung -->
                    <div class="lg:col-span-2 bg-stone-50/60 border border-stone-200/70 p-6 rounded-xl shadow-sm">
                        <div class="flex flex-col mb-4">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600">Statistik Kunjungan</span>
                            <h4 class="text-sm font-bold text-stone-800 mt-0.5">Tren Pengunjung Pekan Ini</h4>
                        </div>
                        <div class="h-64 relative">
                            <canvas id="chartPengunjung"></canvas>
                        </div>
                    </div>

                    <!-- Grafik 2: Komposisi Kategori Berita -->
                    <div class="bg-stone-50/60 border border-stone-200/70 p-6 rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex flex-col mb-4">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600">Statistik Publikasi</span>
                            <h4 class="text-sm font-bold text-stone-800 mt-0.5">Distribusi Kategori Berita</h4>
                        </div>
                        <div class="h-56 flex items-center justify-center relative">
                            <canvas id="chartBerita"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KARTU PINTASAN AKSI KELOLA KONTEN -->
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Kartu 1: Berita -->
                <a href="{{ route('admin.berita.index') }}" class="bg-white border border-stone-200 p-6 rounded-2xl shadow-sm hover:border-amber-500 hover:shadow-md transition group flex flex-col justify-between">
                    <div>
                        <div class="text-3xl mb-3">📰</div>
                        <h3 class="font-bold text-stone-800 group-hover:text-amber-700 transition text-base">Kelola Berita</h3>
                        <p class="text-xs text-stone-500 mt-1">Tambah, ubah, dan publikasikan artikel berita museum.</p>
                    </div>
                    <span class="mt-4 text-xs font-bold text-amber-700 flex items-center gap-1 group-hover:translate-x-1 transition-transform">Kelola Sekarang →</span>
                </a>

                <!-- Kartu 2: Galeri 3D -->
                <a href="{{ route('admin.galeri.index') }}" class="bg-white border border-stone-200 p-6 rounded-2xl shadow-sm hover:border-amber-500 hover:shadow-md transition group flex flex-col justify-between">
                    <div>
                        <div class="text-3xl mb-3">🏺</div>
                        <h3 class="font-bold text-stone-800 group-hover:text-amber-700 transition text-base">Katalog Artefak</h3>
                        <p class="text-xs text-stone-500 mt-1">Kelola arsip foto & model 3D pusaka museum.</p>
                    </div>
                    <span class="mt-4 text-xs font-bold text-amber-700 flex items-center gap-1 group-hover:translate-x-1 transition-transform">Kelola Sekarang →</span>
                </a>

                <!-- Kartu 3: Walang Suji & Gosali -->
                <a href="{{ route('admin.walangsuji.index') }}" class="bg-white border border-stone-200 p-6 rounded-2xl shadow-sm hover:border-amber-500 hover:shadow-md transition group flex flex-col justify-between">
                    <div>
                        <div class="text-3xl mb-3">🎥</div>
                        <h3 class="font-bold text-stone-800 group-hover:text-amber-700 transition text-base">Living Museum</h3>
                        <p class="text-xs text-stone-500 mt-1">Kelola koleksi video Walang Suji & Gosali.</p>
                    </div>
                    <span class="mt-4 text-xs font-bold text-amber-700 flex items-center gap-1 group-hover:translate-x-1 transition-transform">Kelola Sekarang →</span>
                </a>

                <!-- Kartu 4: Beranda & Hero -->
                <a href="{{ route('admin.beranda.index') }}" class="bg-white border border-stone-200 p-6 rounded-2xl shadow-sm hover:border-amber-500 hover:shadow-md transition group flex flex-col justify-between">
                    <div>
                        <div class="text-3xl mb-3">🖼️</div>
                        <h3 class="font-bold text-stone-800 group-hover:text-amber-700 transition text-base">Konten Beranda</h3>
                        <p class="text-xs text-stone-500 mt-1">Ubah banner hero, sambutan, dan kartu beranda.</p>
                    </div>
                    <span class="mt-4 text-xs font-bold text-amber-700 flex items-center gap-1 group-hover:translate-x-1 transition-transform">Kelola Sekarang →</span>
                </a>
            </div>

        </div>
    </div>

    <!-- Pustaka Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Grafik Pengunjung (Line Chart)
            const elPengunjung = document.getElementById('chartPengunjung');
            if (elPengunjung) {
                const ctxPengunjung = elPengunjung.getContext('2d');
                new Chart(ctxPengunjung, {
                    type: 'line',
                    data: {
                        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        datasets: [{
                            label: 'Jumlah Pengunjung',
                            data: [120, 185, 210, 195, 260, 340, 310],
                            borderColor: '#b45309',
                            backgroundColor: 'rgba(180, 83, 9, 0.05)',
                            borderWidth: 2.5,
                            tension: 0.35,
                            fill: true,
                            pointBackgroundColor: '#b45309'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { grid: { display: true, color: '#f3f4f6' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            // 2. Grafik Kategori Berita (Doughnut Chart)
            const elBerita = document.getElementById('chartBerita');
            if (elBerita) {
                const ctxBerita = elBerita.getContext('2d');
                new Chart(ctxBerita, {
                    type: 'doughnut',
                    data: {
                        labels: ['Konservasi', 'Edukasi', 'Eksibisi'],
                        datasets: [{
                            data: [14, 9, 6],
                            backgroundColor: ['#b45309', '#d97706', '#78716c'],
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { boxWidth: 12, font: { size: 11 } }
                            }
                        },
                        cutout: '70%'
                    }
                });
            }
        });
    </script>
</x-app-layout>
