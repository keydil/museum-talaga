<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Aplikasi Arsip & Koleksi 3D
    |--------------------------------------------------------------------------
    |
    | Katalog artefak dan arsip naskah lontar sekarang dikelola oleh aplikasi
    | terpisah (Next.js + Supabase + Cloudflare R2) yang berjalan di subdomain
    | sendiri. Aplikasi itulah sumber data tunggal untuk koleksi artefak —
    | halaman /galeri di sini sudah dipensiunkan dan hanya me-redirect.
    |
    | Alasan dipisah: katalog di sana punya data yang jauh lebih dalam
    | (deskripsi dua bahasa, dimensi/material/provenance, galeri banyak foto,
    | model 3D interaktif), sementara portal ini fokus ke profil & berita.
    |
    */

    'url' => rtrim(env('ARSIP_URL', 'https://artefak.museumtalagamanggung.com'), '/'),

    /*
    |--------------------------------------------------------------------------
    | Pemetaan Artefak Lama -> Slug Arsip
    |--------------------------------------------------------------------------
    |
    | Tautan lama berbentuk /galeri/{id} (id numerik dari tabel `galeris`).
    | Peta ini dipakai supaya tautan itu tetap mendarat di artefak yang benar
    | di aplikasi Arsip, bukan cuma dilempar ke halaman katalog.
    |
    | Kuncinya judul artefak (bukan id) karena id bergantung urutan seeder
    | dan bisa berubah kalau tabelnya di-seed ulang. Pencocokan dilakukan
    | case-insensitive; kalau tidak ketemu, pengunjung diarahkan ke halaman
    | katalog Arsip sebagai jaring aman.
    |
    */

    'slug_map' => [
        'Arca Raden Panglurah' => 'raden-panglurah',
        'Arca Simbar Kancana' => 'simbar-kancana',
        'Keris Pusaka Karuhun Talaga' => 'keris-talaga',
        'Kujang Pusaka Sunda Kuno' => 'kujang-talaga',
        'Tombak Pusaka Kerajaan' => 'tombak-talaga',
        'Baju Kere (Zirah Baja Kuno)' => 'baju-kere',
        'Golok Pusaka Kerajaan' => 'golok-talaga',
        'Cawan Zodiak Talaga (Prasen)' => 'cawan-zodiak-talaga',
        'Genta Teratai Buddha' => 'genta-teratai-buddha',
        'Genta Singha Talaga' => 'genta-singha-talaga',
        'Koleksi Terracotta & Keramik Kuno' => 'terracotta-talaga',
        'Mata Uang Gobog Kuno' => 'mata-uang-gobog',
        'Perangkat Goong Renteng & Kenong' => 'goong-renteng',
        'Meriam Cetbang & Rantaka' => 'cetbang-talaga',
        'Senapan Sulut Arquebush (Bedil Dorlok)' => 'bedil-dorlok',
        'Batu Lingga Yoni' => 'batu-lingga-yoni',
        'Batu Palungguhan / Batu Pentasbih' => 'batu-palungguhan',
    ],

];
