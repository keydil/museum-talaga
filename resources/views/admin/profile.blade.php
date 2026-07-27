<x-app-layout>
    <!-- Memuat aset AOS jika diperlukan untuk transisi halus halaman -->
    <link rel="stylesheet" href="https://unpkg.com" />

    <!-- Pembungkus Utama Menggunakan Latar Belakang Krem Khas Museum -->
    <div class="min-h-screen bg-[#fdfbf2] py-12 font-sans">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-8">
            
            <!-- Header Pengaturan Profil (Se-tema dengan Berita & Galeri) -->
            <div class="flex flex-col items-start">
                <span class="bg-amber-100/70 border border-amber-200 text-amber-800 text-[10px] md:text-xs font-bold tracking-wider px-4 py-1.5 rounded-full mb-4 uppercase">
                    Keamanan Operator
                </span>
                <h1 class="text-3xl md:text-4xl font-black text-amber-700 tracking-tight leading-tight">
                    {{ __('Pengaturan Profil Admin') }}
                </h1>
                <p class="text-sm text-stone-500 mt-2">
                    Perbarui informasi kredensial masuk, kata sandi keamanan, dan kelola otoritas akun Anda di sini.
                </p>
            </div>

            <!-- Bagian 1: Update Informasi Profil -->
            <div class="p-6 sm:p-8 bg-white border border-amber-200/60 shadow-sm rounded-2xl hover:shadow-md transition-all duration-300">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <!-- Bagian 2: Ubah Kata Sandi -->
            <div class="p-6 sm:p-8 bg-white border border-amber-200/60 shadow-sm rounded-2xl hover:shadow-md transition-all duration-300">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <!-- Bagian 3: Hapus Pengguna -->
            <div class="p-6 sm:p-8 bg-white border border-amber-200/60 shadow-sm rounded-2xl hover:shadow-md transition-all duration-300">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>

        </div>
    </div>

    <!-- Script Pengaktif Animasi Masuk AOS -->
    <script src="https://unpkg.com"></script>
    <script>
        AOS.init({
            once: true,
            easing: 'ease-out-cubic'
        });
    </script>
</x-app-layout>
