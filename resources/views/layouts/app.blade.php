<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://bunny.net" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Tambahkan baris ini di dalam tag head aplikasi Anda jika belum ada -->
    <script defer src="https://jsdelivr.net"></script>
    <script defer src="https://jsdelivr.net"></script>

    <style>
        /* CSS tambahan untuk mencegah menu berkedip saat pertama dimuat */
        [x-cloak] { display: none !important; }
        /* Menghilangkan panah bawaan browser pada tag summary */
summary::-webkit-details-marker,
summary::marker {
    display: none !important;
    content: "";
}

/* Animasi slide down untuk konten details */
details[open] + div, 
details .dropdown-content {
    animation: slideDown 0.25s ease-out-step;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    </style>
    </head>
    <!-- PERBAIKAN: Mengunci warna dasar body menggunakan warna krem museum agar tidak ada bocor hitam -->
    <body class="font-sans antialiased bg-[#fdfbf2]">
        
        <div class="min-h-screen bg-[#fdfbf2]">
            <livewire:layout.navigation />

            <div id="adminMainContent" class="pt-16 pl-0 transition-all duration-300 ease-in-out lg:pt-0 lg:pl-64">
                
                <!-- Page Heading (Opsional, sudah dibersihkan dari warna gelap bawaan) -->
                @if (isset($header))
                    <header class="bg-white border-b border-amber-200/60 shadow-sm">
                        <div class="max-w-7xl mx-auto py-6 px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content (Dashboard / Profile) -->
                <main>
                    {{ $slot }}
                </main>
                
            </div>
        </div>
    </body>
</html>
