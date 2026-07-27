<x-app-layout>
    <!-- Tambahkan aset AOS jika layout utama (app-layout) Anda belum memuatnya -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <!-- Pembungkus Konten Utama dengan Latar Belakang Krem Khas Museum -->
    <div class="min-h-screen bg-[#fdfbf2] py-12 font-sans">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <!-- Bagian Judul Dashboard -->
            <div class="mb-10 flex flex-col items-start">
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
            <div class="bg-white border border-amber-200/60 overflow-hidden shadow-sm rounded-2xl p-8 hover:shadow-md transition-shadow duration-300 mb-8">
                
                <!-- Indikator Kunjungan Real-Time Bergaya Minimalis -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-stone-100 pb-6 mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 border border-amber-200 text-amber-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-stone-500">Pengunjung Unik Hari Ini</h3>
                            <p class="text-xl font-black text-amber-900">{{ number_format($todayViews ?? 0) }} <span class="text-xs font-normal text-stone-500">perangkat</span></p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-stone-500">Akumulasi Pengunjung Unik</h3>
                            <p class="text-xl font-black text-emerald-900">{{ number_format($totalViews ?? 0) }} <span class="text-xs font-normal text-stone-500">total orang</span></p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 border border-blue-200 text-blue-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-stone-500">Status Anti-Spam Tracker</h3>
                            <p class="text-xs font-bold text-blue-900 flex items-center gap-1 mt-1">
                                <span class="h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span> Unique IP Filter Aktif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- GRAFIK DATA OPERASIONAL -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 font-sans">
                    <!-- Grafik 1: Tren Pengunjung -->
                    <div class="lg:col-span-2 bg-stone-50/60 border border-stone-200/70 p-6 rounded-xl shadow-sm">
                        <div class="flex flex-col mb-4">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600">Statistik Real-Time</span>
                            <h4 class="text-sm font-bold text-stone-800 mt-0.5">Tren Pengunjung Pekan Ini (Real)</h4>
                        </div>
                        <div class="h-64 relative">
                            <canvas id="chartPengunjung"></canvas>
                        </div>
                    </div>

                    <!-- Grafik 2: Komposisi Kategori Berita -->
                    <div class="bg-stone-50/60 border border-stone-200/70 p-6 rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex flex-col mb-4">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600">Statistik Konten Data</span>
                            <h4 class="text-sm font-bold text-stone-800 mt-0.5">Distribusi Konten Museum</h4>
                        </div>
                        <div class="h-56 flex items-center justify-center relative">
                            <canvas id="chartBerita"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KARTU PINTASAN AKSI KELOLA KONTEN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
        function initDashboardCharts() {
            // 1. Grafik Pengunjung Real-Time (Line Chart)
            const elPengunjung = document.getElementById('chartPengunjung');
            if (elPengunjung) {
                const existingChart = Chart.getChart(elPengunjung);
                if (existingChart) {
                    existingChart.destroy();
                }

                const ctxPengunjung = elPengunjung.getContext('2d');
                const daysLabel = {!! json_encode($days) !!};
                const realVisitorCounts = {!! json_encode($visitorCounts) !!};

                new Chart(ctxPengunjung, {
                    type: 'line',
                    data: {
                        labels: daysLabel,
                        datasets: [{
                            label: 'Jumlah Hits Pengunjung Real',
                            data: realVisitorCounts,
                            borderColor: '#b45309',
                            backgroundColor: 'rgba(180, 83, 9, 0.08)',
                            borderWidth: 2.5,
                            tension: 0.35,
                            fill: true,
                            pointBackgroundColor: '#b45309',
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y + ' Hits Pengunjung';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: { 
                                beginAtZero: true,
                                grid: { display: true, color: '#f3f4f6' },
                                ticks: { precision: 0 }
                            },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            // 2. Grafik Distribusi Konten Museum Real (Doughnut Chart)
            const elBerita = document.getElementById('chartBerita');
            if (elBerita) {
                const existingChartBerita = Chart.getChart(elBerita);
                if (existingChartBerita) {
                    existingChartBerita.destroy();
                }

                const ctxBerita = elBerita.getContext('2d');
                const contentDist = {!! json_encode($contentDistribution) !!};

                new Chart(ctxBerita, {
                    type: 'doughnut',
                    data: {
                        labels: ['Artikel Berita', 'Artefak 3D Galeri', 'Video Living Museum'],
                        datasets: [{
                            data: [contentDist.berita, contentDist.galeri, contentDist.video],
                            backgroundColor: ['#b45309', '#d97706', '#059669'],
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
        }

        // Jalankan saat load biasa maupun saat navigasi Livewire (wire:navigate)
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(initDashboardCharts, 50);
        }
        document.addEventListener('DOMContentLoaded', initDashboardCharts);
        document.addEventListener('livewire:navigated', initDashboardCharts);
    </script>
</x-app-layout>
