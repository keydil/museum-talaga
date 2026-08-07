<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Actions\Logout; // Pastikan class action ini di-import di atas

Route::middleware('guest')->group(function () {
    // Pendaftaran publik DIMATIKAN.
    //
    // Panel admin cuma dilindungi middleware ['auth','verified'] tanpa sistem
    // role — artinya siapa pun yang berhasil mendaftar lalu verifikasi email
    // langsung punya akses admin penuh (bisa mengubah & menghapus seluruh
    // konten situs). Museum tidak butuh pendaftaran mandiri.
    //
    // Menambah pengelola baru: lewat `php artisan tinker` di server, atau
    // seeder. View yang menaut ke rute ini sudah dibungkus
    // `@if (Route::has('register'))` jadi otomatis menyesuaikan.
    //
    // Volt::route('register', 'pages.auth.register')->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    // Tambahkan baris ini di paling bawah dalam grup auth:
    Route::post('logout', function (Logout $logout) {
        $logout();
        return redirect('/');
    })->name('logout');

    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');
    // ... rute lainnya
});