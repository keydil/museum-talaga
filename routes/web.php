<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\SejarahAdminController;
use App\Http\Controllers\VisiMisiAdminController;
use App\Http\Controllers\HomeSectionController;
use App\Http\Controllers\HomeCardController;
use App\Http\Controllers\WalangSujiController;
use App\Http\Controllers\GosaliVideoController;
use App\Http\Controllers\StrukturOrgController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FooterController;

/*
|--------------------------------------------------------------------------
| Halaman Utama & Publik (Public Routes)
|--------------------------------------------------------------------------
*/

Route::get('/', [HalamanController::class, 'index'])->name('welcome');

// Route Publik Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Route Publik Galeri — DIPENSIUNKAN.
// Katalog artefak sekarang dikelola aplikasi Arsip di subdomain terpisah
// (lihat config/arsip.php). Route ini dipertahankan sebagai redirect 301
// supaya tautan lama, bookmark, hasil pencarian Google, dan Home Card di
// dashboard admin yang masih menunjuk /galeri tidak jadi mati.
// Pakai permanentRedirect (bukan closure) supaya route ini tetap aman waktu
// `php artisan route:cache` dijalankan saat deploy — closure tidak bisa
// diserialisasi dan bikin deploy gagal.
Route::permanentRedirect('/galeri', config('arsip.url') . '/koleksi')->name('galeri');
Route::get('/galeri/{galeri}', [GaleriController::class, 'redirectToArsip'])->name('galeri.show');

// Route Profil & Informasi Museum
Route::get('/sejarah', [HalamanController::class, 'sejarah'])->name('sejarah');
Route::get('/visimisi', [HalamanController::class, 'visimisi'])->name('visimisi');
Route::get('/strukturorg', [HalamanController::class, 'strukturorg'])->name('strukturorg');

// Route Living Museum
Route::get('/walangsuji', [HalamanController::class, 'walangsuji'])->name('walangsuji');
Route::get('/gosali', [HalamanController::class, 'gosali'])->name('gosali');

/*
|--------------------------------------------------------------------------
| Panel Admin (Authenticated Routes)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard & Profil
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('profile', 'admin.profile')->name('profile');

    // Manajemen Beranda (Hero & Sections)
    Route::get('beranda', [HomeSectionController::class, 'index'])->name('admin.beranda.index');
    Route::post('beranda/update', [HomeSectionController::class, 'update'])->name('admin.beranda.update');

    // Manajemen Footer Admin
    Route::get('footer-admin', [FooterController::class, 'index'])->name('admin.footer.index');
    Route::post('footer-admin/update', [FooterController::class, 'update'])->name('admin.footer.update');

    // Manajemen Home Cards (Kartu Koleksi Beranda)
    Route::resource('home-cards', HomeCardController::class)->names([
        'index'   => 'admin.home-cards.index',
        'create'  => 'admin.home-cards.create',
        'store'   => 'admin.home-cards.store',
        'edit'    => 'admin.home-cards.edit',
        'update'  => 'admin.home-cards.update',
        'destroy' => 'admin.home-cards.destroy',
    ]);

    // Manajemen Halaman Profil (Sejarah, Visi Misi, Struktur Org)
    Route::name('admin.')->group(function () {
        Route::get('sejarah', [SejarahAdminController::class, 'index'])->name('sejarah.index');
        Route::post('sejarah/update', [SejarahAdminController::class, 'update'])->name('sejarah.update');

        Route::get('visimisi', [VisiMisiAdminController::class, 'index'])->name('visimisi.index');
        Route::post('visimisi/update', [VisiMisiAdminController::class, 'update'])->name('visimisi.update');

        Route::get('strukturorg', [StrukturOrgController::class, 'index'])->name('strukturorg.index');
        Route::put('strukturorg/update', [StrukturOrgController::class, 'update'])->name('strukturorg.update');
    });

    // Manajemen Galeri Admin
    Route::get('galeri-admin', [GaleriController::class, 'adminIndex'])->name('admin.galeri.index');
    Route::put('galeri-admin/update-header', [GaleriController::class, 'updateHeader'])->name('admin.setting.update-header');
    Route::resource('galeri', GaleriController::class)->except(['index'])->names([
        'create'  => 'admin.galeri.create',
        'store'   => 'admin.galeri.store',
        'edit'    => 'admin.galeri.edit',
        'update'  => 'admin.galeri.update',
        'destroy' => 'admin.galeri.destroy',
    ]);

    // Manajemen Berita Admin
    Route::get('berita-admin', [BeritaController::class, 'adminIndex'])->name('admin.berita.index');
    Route::resource('berita', BeritaController::class)->except(['index', 'show'])->names([
        'create'  => 'admin.berita.create',
        'store'   => 'admin.berita.store',
        'edit'    => 'admin.berita.edit',
        'update'  => 'admin.berita.update',
        'destroy' => 'admin.berita.destroy',
    ]);

    // Manajemen Living Museum - Walang Suji
    Route::get('walangsuji-admin', [WalangSujiController::class, 'index'])->name('admin.walangsuji.index');
    Route::post('walangsuji-admin/store', [WalangSujiController::class, 'store'])->name('admin.walangsuji.store');
    Route::get('walangsuji-admin/{id}/edit', [WalangSujiController::class, 'edit'])->name('admin.walangsuji.edit');
    Route::put('walangsuji-admin/{id}', [WalangSujiController::class, 'update'])->name('admin.walangsuji.update');
    Route::delete('walangsuji-admin/{id}', [WalangSujiController::class, 'destroy'])->name('admin.walangsuji.destroy');
    Route::post('walangsuji-admin/reorder', [WalangSujiController::class, 'reorder'])->name('admin.walangsuji.reorder');

    // Manajemen Living Museum - Gosali
    Route::get('gosali-admin', [GosaliVideoController::class, 'index'])->name('admin.gosali.index');
    Route::post('gosali-admin/store', [GosaliVideoController::class, 'store'])->name('admin.gosali.store');
    Route::get('gosali-admin/{id}/edit', [GosaliVideoController::class, 'edit'])->name('admin.gosali.edit');
    Route::put('gosali-admin/{id}', [GosaliVideoController::class, 'update'])->name('admin.gosali.update');
    Route::delete('gosali-admin/{id}', [GosaliVideoController::class, 'destroy'])->name('admin.gosali.destroy');
    Route::post('gosali-admin/reorder', [GosaliVideoController::class, 'reorder'])->name('admin.gosali.reorder');

    // Placeholder Dinamis
    Route::get('modul/{menu}', function ($menu) {
        $namaMenu = ucwords(str_replace('-', ' ', $menu));
        return view('admin.placeholder', compact('namaMenu', 'menu'));
    })->name('admin.modul');

});

require __DIR__.'/auth.php';
