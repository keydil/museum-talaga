<?php

use App\Livewire\Actions\Logout;
use function Livewire\Volt\action;
use Illuminate\Support\Str;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

@php
    $linkBase = 'group flex w-full items-center gap-3 min-h-[2.75rem] rounded-xl border-l-4 px-3 py-2 text-sm font-semibold leading-5 transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500/30';
    $linkIdle = 'border-transparent text-stone-600 hover:border-amber-200/80 hover:bg-stone-50 hover:text-amber-700';
    $linkActive = 'border-amber-600 bg-amber-50 text-amber-700';
    $iconBase = 'h-5 w-5 shrink-0';
    $iconIdle = 'text-stone-400 group-hover:text-amber-600';
    $iconActive = 'text-amber-600';

    $navLink = fn (bool $active): string => $linkBase.' '.($active ? $linkActive : $linkIdle);
    $iconClass = fn (bool $active): string => $iconBase.' '.($active ? $iconActive : $iconIdle);
@endphp

<div
    x-data="{ sidebarOpen: false }"
    @sidebar-close="sidebarOpen = false"
    @keydown.escape.window="sidebarOpen = false"
>
    {{-- Top bar mobile / tablet --}}
    <header class="fixed inset-x-0 top-0 z-40 flex h-16 items-center gap-3 border-b border-amber-200/60 bg-white/95 px-4 shadow-sm backdrop-blur-sm lg:hidden">
        <button
            type="button"
            @click="sidebarOpen = ! sidebarOpen"
            class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-stone-600 transition-colors duration-200 hover:bg-amber-50 hover:text-amber-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500/30"
            :aria-expanded="sidebarOpen"
            aria-controls="adminSidebar"
            aria-label="{{ __('Toggle menu navigasi') }}"
        >
            <svg x-show="! sidebarOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg x-show="sidebarOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <a href="{{ route('dashboard') }}" wire:navigate @click="$dispatch('sidebar-close')" class="flex min-w-0 flex-1 items-center gap-2 transition-opacity hover:opacity-80">
            <x-application-logo class="h-7 w-auto shrink-0 fill-current text-amber-700" />
            <span class="truncate text-sm font-black uppercase tracking-tight text-stone-800">Admin Museum</span>
        </a>
    </header>

    {{-- Backdrop overlay (mobile / tablet) --}}
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-stone-900/40 backdrop-blur-[1px] lg:hidden"
        style="display: none;"
        aria-hidden="true"
    ></div>

    <nav
        id="adminSidebar"
        class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col overflow-hidden border-r border-amber-200/60 bg-white font-sans shadow-lg transition-transform duration-300 ease-in-out lg:translate-x-0 lg:shadow-sm"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        aria-label="{{ __('Navigasi admin') }}"
    >

        {{-- Header: Logo & identitas --}}
        <div class="flex h-16 shrink-0 items-center border-b border-stone-100 px-4">
            <a href="{{ route('dashboard') }}" wire:navigate @click="$dispatch('sidebar-close')" class="flex min-w-0 items-center gap-3 transition-opacity hover:opacity-80">
                <x-application-logo class="h-8 w-auto shrink-0 fill-current text-amber-700" />
                <span class="truncate text-sm font-black uppercase tracking-tight text-stone-800">Admin Museum</span>
            </a>
        </div>

        {{-- Menu navigasi (scrollable) — tutup sidebar otomatis saat link diklik --}}
        <div
            class="flex flex-1 flex-col gap-1 overflow-x-hidden overflow-y-auto px-3 py-4"
            @click="$event.target.closest('a[href]') && $dispatch('sidebar-close')"
        >
            <span class="mb-1 block px-3 text-[10px] font-bold uppercase tracking-wider text-stone-400">Menu Utama</span>

            @php $active = request()->routeIs('dashboard'); @endphp
            <a href="{{ route('dashboard') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="truncate">{{ __('Dashboard') }}</span>
            </a>

            @php $active = request()->routeIs(['admin.beranda.*', 'admin.home-cards.*']) || request()->is('admin/beranda*', 'admin/home-cards*'); @endphp
            <a href="{{ route('admin.beranda.index') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="truncate">{{ __('Beranda') }}</span>
            </a>

            @php $active = request()->routeIs(['admin.sejarah.*', 'admin.sejarah']) || request()->is('admin/sejarah*'); @endphp
            <a href="{{ route('admin.sejarah.index') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
                <span class="truncate">{{ __('Sejarah') }}</span>
            </a>

            @php $active = request()->routeIs(['admin.visimisi.*', 'admin.visimisi']) || request()->is('admin/visimisi*'); @endphp
            <a href="{{ route('admin.visimisi.index') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="truncate">{{ __('Visi & Misi') }}</span>
            </a>

            @php $active = request()->routeIs(['admin.strukturorg.*', 'admin.strukturorg']) || request()->is('admin/strukturorg*'); @endphp
            <a href="{{ route('admin.strukturorg.index') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                <span class="truncate">{{ __('Struktur Organisasi') }}</span>
            </a>

            @php $active = request()->routeIs(['admin.galeri.*', 'admin.setting.*']) || request()->is('admin/galeri*', 'admin/galeri-admin*'); @endphp
            <a href="{{ route('admin.galeri.index') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="truncate">{{ __('Katalog Galeri') }}</span>
            </a>

            @php $active = request()->routeIs(['admin.berita.*']) || request()->is('admin/berita*', 'admin/berita-admin*'); @endphp
            <a href="{{ route('admin.berita.index') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125H3.375a1.125 1.125 0 0 1-1.125-1.125V5.625c0-.621.504-1.125 1.125-1.125H15.75m-3-1.5h.008v.008H12.75V3Zm0 3h.008v.008H12.75V6Zm0 6h.008v.008H12.75v-.008Zm0 3h.008v.008H12.75V15Z" />
                </svg>
                <span class="truncate">{{ __('Berita') }}</span>
            </a>

            @php $active = request()->routeIs(['admin.walangsuji.*']) || request()->is('admin/walangsuji*'); @endphp
            <a href="{{ route('admin.walangsuji.index') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V5.25a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5Zm3 2.25h7.5m-7.5 4.5h7.5m-7.5 4.5h4.5" />
                </svg>
                <span class="truncate">{{ __('Walangsuji') }}</span>
            </a>

            @php $active = request()->routeIs(['admin.gosali.*']) || request()->is('admin/gosali*'); @endphp
            <a href="{{ route('admin.gosali.index') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V5.25a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5Zm3 2.25h7.5m-7.5 4.5h7.5m-7.5 4.5h4.5" />
                </svg>
                <span class="truncate">{{ __('Gosali') }}</span>
            </a>

            @php $active = request()->routeIs(['admin.footer.*']) || request()->is('admin/footer*'); @endphp
            <a href="{{ route('admin.footer.index') }}" wire:navigate class="{{ $navLink($active) }}">
                <svg class="{{ $iconClass($active) }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <span class="truncate">{{ __('Footer Website') }}</span>
            </a>
        </div>

        {{-- Profil pengguna (fixed di bawah sidebar) --}}
        <div class="shrink-0 border-t border-amber-200/60 bg-stone-50/40 p-3">
            <div class="relative" x-data="{ profileOpen: false }" @click.outside="profileOpen = false">
                <button
                    type="button"
                    @click="profileOpen = ! profileOpen"
                    class="flex w-full items-center gap-3 rounded-xl px-2 py-2 text-left transition-colors duration-200 hover:bg-amber-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500/30"
                    :class="profileOpen ? 'bg-amber-50 ring-1 ring-amber-200/80' : ''"
                    aria-haspopup="true"
                    :aria-expanded="profileOpen"
                >
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-amber-100 text-xs font-bold uppercase text-amber-800">
                        {{ Str::substr(auth()->user()->name, 0, 1) }}
                    </span>

                    <span class="min-w-0 flex-1">
                        <span
                            class="block truncate text-sm font-semibold leading-5 text-stone-800"
                            title="{{ auth()->user()->name }}"
                            x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                            x-text="name"
                            x-on:profile-updated.window="name = $event.detail.name"
                        ></span>
                        <span class="block truncate text-xs leading-4 text-stone-500" title="{{ auth()->user()->email }}">
                            {{ auth()->user()->email }}
                        </span>
                    </span>

                    <svg
                        class="h-4 w-4 shrink-0 text-stone-400 transition-transform duration-200"
                        :class="profileOpen ? 'rotate-180 text-amber-600' : ''"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div
                    x-show="profileOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute bottom-full left-0 right-0 z-50 mb-2 overflow-hidden rounded-xl border border-amber-200/60 bg-white shadow-lg"
                    style="display: none;"
                >
                    <a
                        href="{{ route('profile') }}"
                        wire:navigate
                        class="block px-4 py-2.5 text-sm font-medium text-stone-700 transition-colors hover:bg-amber-50 hover:text-amber-700"
                        @click="profileOpen = false; $dispatch('sidebar-close')"
                    >
                        {{ __('Pengaturan Profil') }}
                    </a>

<form method="POST" action="{{ route('logout') }}" x-ref="logoutForm" class="w-full border-t border-red-100">
    @csrf
    <button 
        type="button" 
        @click="profileOpen = false; $dispatch('sidebar-close'); $refs.logoutForm.submit()" 
        class="w-full text-start"
    >
        <!-- PERBAIKAN CLASS TAILWIND PADA KELAS HOVER DAN TEXT -->
        <x-dropdown-link class="text-red-600 hover:bg-red-600 hover:text-white font-medium py-2.5 transition-colors duration-150">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </button>
</form>


                </div>
            </div>
        </div>
    </nav>
</div>
