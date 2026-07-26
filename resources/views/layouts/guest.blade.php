<!DOCTYPE html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('images/webicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/webicon.png') }}">

        <title>Profil Museum & Arsip Sejarah - Portal Admin</title>

        <!-- Fonts (Bisa disesuaikan jika ingin menggunakan font lain) -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://bunny.net" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <!-- PERBAIKAN: Mengunci background dasar body menggunakan warna krem hangat museum -->
    <body class="font-sans text-stone-900 antialiased bg-[#fdfbf2]">
        
        <!-- 
            PERBAIKAN UTAMA: 
            Menghapus pembungkus logo bawaan Laravel dan kartu putih bawaan (sm:max-w-md bg-white shadow-md).
            Sekarang layout hanya bertugas sebagai wadah fleksibel penuh agar diisi penuh oleh komponen Volt Anda.
        -->
        <div class="min-h-screen flex flex-col justify-center items-center">
            {{ $slot }}
        </div>

    </body>
</html>

