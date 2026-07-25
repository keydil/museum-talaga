<!-- FOOTER STATIS DENGAN TIGA KOLOM DAN GOOGLE MAP -->
<footer class="bg-[#1c1917] text-stone-400 text-xs border-t border-stone-800 font-sans mt-auto w-full overflow-hidden">
    <!-- BAGIAN KONTEN TIGA KOLOM -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <!-- KOLOM 1: INFORMASI MUSEUM -->
            <div class="flex flex-col justify-between space-y-2">
                <div>
                    <h3 class="text-white font-serif font-black text-sm tracking-tight mb-2">Museum Talaga Manggung</h3>
                    <p class="text-stone-500 leading-relaxed text-[11px]">Wadah pelestarian benda pusaka, manuskrip kuno, dan rekam jejak sejarah peradaban institusi.</p>
                </div>
                <p class="text-stone-600 pt-4 md:pt-0">© 2026 Hak Cipta Dilindungi.</p>
            </div>

            <!-- KOLOM 2: AKSES CEPAT -->
            <div class="flex flex-col space-y-2.5">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1">Akses Cepat</h4>
                <div class="grid grid-cols-2 gap-x-4 gap-y-2 max-w-xs mx-auto md:mx-0 text-left">
                    <a href="/" class="hover:text-white hover:underline transition">Beranda</a>
                    <a href="/berita" class="hover:text-white hover:underline transition">Berita</a>
                    <a href="/galeri" class="hover:text-white hover:underline transition">Galeri</a>
                    <a href="/gosali" class="hover:text-white hover:underline transition">Gosali</a>
                </div>
            </div>

            <!-- KOLOM 3: INFORMASI HUKUM -->
            <div class="flex flex-col space-y-2.5">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1">Informasi Hukum</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white transition">Bantuan & Kontak</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- BAGIAN GOOGLE MAP -->
    <div class="bg-[#2d2520] border-t border-stone-800 py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] text-center md:text-left">Lokasi Museum</h4>
            </div>
            <!-- Kontainer Map Clickable -->
            <a href="https://www.google.com/maps/place/Museum+Talaga+Manggung/@-6.9851356,108.3086005,17z/data=!3m1!4b1!4m6!3m5!1s0x2e6f395fa55e192b:0xee866e083162a0e5!8m2!3d-6.9851409!4d108.3111701!16s%2Fg%2F120n2ktr?hl=en-US&entry=ttu&g_ep=EgoyMDI2MDcyMi4wIKXMDSoASAFQAw%3D%3D" 
               target="_blank" 
               rel="noopener noreferrer"
               class="block w-full h-64 md:h-80 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 cursor-pointer group relative">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8271234567890!2d107.5!3d-7.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMuseum%20Talaga%20Manggung!5e0!3m2!1sid!2sid!4v1626000000000" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="pointer-events-none">
                </iframe>
                <!-- Overlay Hint: Buka di Google Maps -->
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center gap-2 bg-amber-600 text-white px-4 py-2 rounded-lg text-xs font-semibold">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                        </svg>
                        Buka di Google Maps
                    </div>
                </div>
            </a>
        </div>
    </div>
</footer>
