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
use App\Http\Controllers\FooterController;
use App\Http\Controllers\StrukturOrgController;


// Halaman Utama Publik
Route::get('/', [HalamanController::class, 'index'])->name('welcome');

// Route untuk halaman berita
Route::get('/berita', [HalamanController::class, 'berita'])->name('berita');

// Route untuk halaman galeri publik
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/galeri/{galeri}', [GaleriController::class, 'show'])->name('galeri.show');

Route::get('/sejarah', [HalamanController::class, 'sejarah'])->name('sejarah');

Route::get('/visimisi', [HalamanController::class, 'visimisi'])->name('visimisi');

Route::get('/strukturorg', [HalamanController::class, 'strukturorg'])->name('strukturorg');

Route::get('/walangsuji', [HalamanController::class, 'walangsuji'])->name('walangsuji');

Route::get('/gosali', [HalamanController::class, 'gosali'])->name('gosali');

// Rute otomatis untuk seluruh fungsi CRUD
Route::resource('/berita', BeritaController::class);

// Grup Route Admin (Otomatis menggunakan awalan url /admin)
Route::prefix('admin')->middleware(['auth'])->group(function () {

    // 1. Mengarah ke views/admin/dashboard.blade.php
    Route::view('dashboard', 'admin.dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    // 2. Mengarah ke views/admin/profile.blade.php
    Route::view('profile', 'admin.profile')
        ->name('profile');

    // 3. Mengarah ke views/admin/adm-beranda.blade.php (Halaman Baru Anda)
    Route::get('beranda', [App\Http\Controllers\HomeSectionController::class, 'index'])
        ->middleware(['verified'])
        ->name('admin.beranda.index');

    Route::post('beranda/update', [App\Http\Controllers\HomeSectionController::class, 'update'])
        ->middleware(['verified'])
        ->name('admin.beranda.update');

    Route::resource('home-cards', App\Http\Controllers\HomeCardController::class)
        ->names([
            'index' => 'admin.home-cards.index',
            'create' => 'admin.home-cards.create',
            'store' => 'admin.home-cards.store',
            'edit' => 'admin.home-cards.edit',
            'update' => 'admin.home-cards.update',
            'destroy' => 'admin.home-cards.destroy',
        ])
        ->middleware(['auth', 'verified']);

    // ROUTES FOOTER DINONAKTIFKAN - Footer sekarang statis tanpa admin management
    // Route::get('footer', [FooterController::class, 'index'])
    //     ->middleware(['verified'])
    //     ->name('admin.footer.index');

    // Route::post('footer/update', [FooterController::class, 'update'])
    //     ->middleware(['verified'])
    //     ->name('admin.footer.update');

    Route::middleware(['auth', 'verified'])->name('admin.')->group(function () {
        Route::get('sejarah', [SejarahAdminController::class, 'index'])->name('sejarah.index');
        Route::post('sejarah/update', [SejarahAdminController::class, 'update'])->name('sejarah.update');
        Route::get('visimisi', [VisiMisiAdminController::class, 'index'])->name('visimisi.index');
        Route::post('visimisi/update', [VisiMisiAdminController::class, 'update'])->name('visimisi.update');
    });

    // 6. Mengarah ke views/admin/admstog.blade.php (Halaman Struktur Organisasi Admin)
    // Rute konvensional (jika Anda masih ingin memanggil via view index biasa)
// 1. Rute untuk MENAMPILKAN halaman admin struktur organisasi
Route::get('strukturorg', [StrukturOrgController::class, 'index'])
    ->middleware(['auth', 'verified']) // Disarankan ditambah middleware 'auth' untuk keamanan panel admin
    ->name('admin.strukturorg.index');

// 2. Rute untuk PROSES MENYIMPAN data gambar & deskripsi (Solusi Eror Route Not Found)
Route::put('strukturorg/update', [StrukturOrgController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('admin.strukturorg.update'); 

    // 7. Mengarah ke views/admin/admgaleri.blade.php (Halaman Galeri Admin)
    Route::get('galeri-admin', [App\Http\Controllers\GaleriController::class, 'adminIndex'])
        ->middleware(['auth', 'verified'])
        ->name('admin.galeri.index');

    // 4. BARU: Rute otomatis untuk seluruh fungsi CRUD Galeri Admin (Terhubung ke GaleriController)
    // URL otomatis menjadi: /admin/galeri, /admin/galeri/create, dll.
    Route::resource('galeri', App\Http\Controllers\GaleriController::class)
        ->names([
            'index'   => 'admin.galeri.index',
            'create'  => 'admin.galeri.create',
            'store'   => 'admin.galeri.store',
            'edit'    => 'admin.galeri.edit',
            'update'  => 'admin.galeri.update',
            'destroy' => 'admin.galeri.destroy',
        ])
        ->middleware(['auth', 'verified']);
    // Tambahkan rute ini untuk memproses submit form dari Editor Header
    Route::put('galeri-admin/update-header', [App\Http\Controllers\GaleriController::class, 'updateHeader'])
    ->name('admin.setting.update-header')
    ->middleware(['auth', 'verified']);


    // Mengarah ke Controller untuk menangani tampilan tabel CRUD berita admin
    Route::get('berita-admin', [App\Http\Controllers\BeritaController::class, 'adminIndex'])
        ->middleware(['auth', 'verified'])
        ->name('admin.berita.index');

// Rute untuk halaman utama manajemen Walang Suji di Panel Admin
Route::get('walangsuji-admin', [App\Http\Controllers\WalangSujiController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('admin.walangsuji.index');

// Rute untuk memproses penyimpanan video baru
Route::post('walangsuji-admin/store', [App\Http\Controllers\WalangSujiController::class, 'store'])
        ->middleware(['auth', 'verified'])
        ->name('admin.walangsuji.store');

// Rute untuk menampilkan halaman edit video
Route::get('walangsuji-admin/{id}/edit', [App\Http\Controllers\WalangSujiController::class, 'edit'])
        ->middleware(['auth', 'verified'])
        ->name('admin.walangsuji.edit');

// Rute untuk memperbarui video
Route::put('walangsuji-admin/{id}', [App\Http\Controllers\WalangSujiController::class, 'update'])
        ->middleware(['auth', 'verified'])
        ->name('admin.walangsuji.update');

// Rute untuk menghapus video
Route::delete('walangsuji-admin/{id}', [App\Http\Controllers\WalangSujiController::class, 'destroy'])
        ->middleware(['auth', 'verified'])
        ->name('admin.walangsuji.destroy');

// Rute untuk mengatur ulang urutan playlist dengan drag-and-drop
Route::post('walangsuji-admin/reorder', [App\Http\Controllers\WalangSujiController::class, 'reorder'])
        ->middleware(['auth', 'verified'])
        ->name('admin.walangsuji.reorder');

Route::get('gosali-admin', [GosaliVideoController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('admin.gosali.index');

Route::post('gosali-admin/store', [GosaliVideoController::class, 'store'])
        ->middleware(['auth', 'verified'])
        ->name('admin.gosali.store');

Route::get('gosali-admin/{id}/edit', [GosaliVideoController::class, 'edit'])
        ->middleware(['auth', 'verified'])
        ->name('admin.gosali.edit');

Route::put('gosali-admin/{id}', [GosaliVideoController::class, 'update'])
        ->middleware(['auth', 'verified'])
        ->name('admin.gosali.update');

Route::delete('gosali-admin/{id}', [GosaliVideoController::class, 'destroy'])
        ->middleware(['auth', 'verified'])
        ->name('admin.gosali.destroy');

Route::post('gosali-admin/reorder', [GosaliVideoController::class, 'reorder'])
        ->middleware(['auth', 'verified'])
        ->name('admin.gosali.reorder');
    // 10. Rute otomatis untuk seluruh fungsi CRUD Berita Admin
    // URL otomatis menjadi: /admin/berita, /admin/berita/create, dll.
    Route::resource('berita', App\Http\Controllers\BeritaController::class)
        ->middleware(['verified'])
        ->names([
            'index' => 'admin.berita.index',
            'create' => 'admin.berita.create',
            'store' => 'admin.berita.store',
            'edit' => 'admin.berita.edit',
            'update' => 'admin.berita.update',
            'destroy' => 'admin.berita.destroy',
        ]);

    // 5. Rute Placeholder Dinamis untuk Menu Lain yang Belum Dibuat Filenya
    Route::get('modul/{menu}', function ($menu) {
        $namaMenu = ucwords(str_replace('-', ' ', $menu));
        return view('admin.placeholder', compact('namaMenu', 'menu'));
    })->name('admin.modul');

}); // Akhir dari Grup Route Admin

require __DIR__.'/auth.php';
