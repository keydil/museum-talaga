<!-- FOOTER STATIS SAKRAL DENGAN 4 KOLOM DAN GOOGLE MAPS -->
<footer class="bg-[#1c1917] text-stone-400 text-xs border-t border-stone-800 font-sans mt-auto w-full overflow-hidden">
    <!-- BAGIAN KONTEN EMPAT KOLOM -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-left">
            
            <!-- KOLOM 1: INFORMASI MUSEUM -->
            <div class="flex flex-col justify-between space-y-3">
                <div>
                    <h3 class="text-white font-serif font-black text-sm tracking-tight mb-2 flex items-center gap-2">
                        <span class="text-amber-500">🏛️</span> Museum Talaga Manggung
                    </h3>
                    <div class="flex items-start gap-2 text-stone-400 leading-relaxed text-[11px]">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05A7 7 0 1114.95 14.95L10 19.9l-4.95-4.95A7 7 0 015.05 4.05zM10 6a2 2 0 100 4 2 2 0 000-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-stone-400 leading-relaxed text-[11px]">
                            Jl. Talaga - Majalengka No. 09, Blok Babakan, Desa Talaga Kulon, Kec. Talaga, Kab. Majalengka, Jawa Barat.
                        </p>
                    </div>
                </div>
                <p class="text-stone-500 text-[11px] pt-2">© 2026 Museum Talaga Manggung. Hak Cipta Dilindungi.</p>
            </div>

            <!-- KOLOM 2: PINTASAN NAVIGASI -->
            <div class="flex flex-col space-y-2.5">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1 text-amber-500">Pintasan Halaman</h4>
                <ul class="space-y-2 text-[11px]">
                    <li><a href="{{ route('welcome') }}" wire:navigate class="hover:text-amber-400 transition flex items-center gap-1.5"><span class="text-amber-600">›</span> Beranda Utama</a></li>
                    <li><a href="{{ route('sejarah') }}" wire:navigate class="hover:text-amber-400 transition flex items-center gap-1.5"><span class="text-amber-600">›</span> Sejarah Museum</a></li>
                    <li><a href="{{ route('visimisi') }}" wire:navigate class="hover:text-amber-400 transition flex items-center gap-1.5"><span class="text-amber-600">›</span> Visi & Misi</a></li>
                    <li><a href="{{ route('galeri') }}" wire:navigate class="hover:text-amber-400 transition flex items-center gap-1.5"><span class="text-amber-600">›</span> Katalog Artefak 3D</a></li>
                    <li><a href="{{ route('berita') }}" wire:navigate class="hover:text-amber-400 transition flex items-center gap-1.5"><span class="text-amber-600">›</span> Warta & Berita</a></li>
                </ul>
            </div>

            <!-- KOLOM 3: INFORMASI KONTAK -->
            <div class="flex flex-col space-y-2.5">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1 text-amber-500">Kontak & Layanan</h4>
                <div class="space-y-2 text-[11px] text-stone-400">
                    <p class="flex items-center gap-2">
                        <span class="text-amber-500">📱</span> WhatsApp 1: <a href="https://wa.me/6285770215723" target="_blank" rel="noopener noreferrer" class="hover:text-amber-400 transition">0857-7021-5723</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-amber-500">📱</span> WhatsApp 2: <a href="https://wa.me/6289698371616" target="_blank" rel="noopener noreferrer" class="hover:text-amber-400 transition">0896-9837-1616</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-amber-500">✉️</span> Email: <a href="mailto:karatuantalaga@gmail.com" class="hover:text-amber-400 transition">karatuantalaga@gmail.com</a>
                    </p>
                </div>
            </div>

            <!-- KOLOM 4: MEDIA SOSIAL -->
            <div class="flex flex-col space-y-2.5">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] mb-1 text-amber-500">Media Sosial</h4>
                <div class="space-y-2.5 text-[11px]">
                    <a href="https://www.youtube.com/channel/UCS1FmYR3TTqWEh3lRGnE2jQ/featured" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-stone-400 hover:text-white transition group">
                        <img src="{{ Vite::asset('resources/images/youtube.svg') }}" alt="YouTube" class="w-4 h-4 opacity-80 group-hover:opacity-100 transition">
                        <span>YouTube Resmi</span>
                    </a>
                    <a href="https://www.facebook.com/pranatabudaya.talagamanggung.7" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-stone-400 hover:text-white transition group">
                        <img src="{{ Vite::asset('resources/images/facebook.svg') }}" alt="Facebook" class="w-4 h-4 opacity-80 group-hover:opacity-100 transition">
                        <span>Facebook Komunitas</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- BAGIAN GOOGLE MAPS INTERAKTIF -->
    <div class="bg-[#2a221d] border-t border-stone-800/80 py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-white font-semibold uppercase tracking-wider text-[11px] flex items-center gap-2">
                    <span class="text-amber-500">📍</span> Lokasi Peta Museum Talaga Manggung
                </h4>
                <span class="text-[10px] text-stone-500 hidden sm:inline">Klik peta untuk petunjuk arah langsung</span>
            </div>
            <!-- Kontainer Map Interaktif -->
            <div class="relative w-full h-64 md:h-80 rounded-xl overflow-hidden shadow-xl border border-stone-700/50 group">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.547167732296!2d108.28312527500588!3d-6.828588566736468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f2c733f5d5069%3A0x6a0a03070624a480!2sMuseum%20Talaga%20Manggung!5e0!3m2!1sid!2sid!4v1722053600000!5m2!1sid!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-full border-0 filter contrast-[105%]">
                </iframe>
                <!-- Tombol Buka Petunjuk Arah -->
                <div class="absolute bottom-3 right-3 z-10 pointer-events-auto">
                    <a href="https://www.google.com/maps/place/Museum+Talaga+Manggung/@-6.9851356,108.3086005,17z/data=!3m1!4b1!4m6!3m5!1s0x2e6f395fa55e192b:0xee866e083162a0e5!8m2!3d-6.9851409!4d108.3111701!16s%2Fg%2F120n2ktr?hl=en-US&entry=ttu" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-1.5 bg-amber-600 hover:bg-amber-700 text-white px-3.5 py-2 rounded-lg text-xs font-semibold shadow-lg transition-all transform hover:scale-105">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                        </svg>
                        Buka di Google Maps ↗
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

