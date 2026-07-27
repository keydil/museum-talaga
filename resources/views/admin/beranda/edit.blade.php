<x-app-layout>
    <div class="min-h-screen bg-[#fdfbf2] py-12 font-sans">
        <div class="max-w-2xl mx-auto px-6 lg:px-8">
            
            <!-- Header Halaman -->
            <div class="mb-8">
                <a href="{{ route('admin.home-cards.index') }}" wire:navigate class="text-xs font-bold text-stone-600 hover:text-amber-700 inline-flex items-center gap-1 transition">
                    ← Kembali ke Dashboard Beranda
                </a>
                <h1 class="text-2xl font-black text-amber-700 tracking-tight mt-3">
                    Perbarui Kartu Beranda: {{ $card->title }}
                </h1>
            </div>

            <!-- Formulir Perubahan -->
            <div class="bg-white border border-amber-200/60 rounded-2xl p-8 shadow-sm">
                <form action="{{ route('admin.home-cards.update', $card->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Judul Kartu -->
                    <div>
                        <label for="title" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Judul Kartu (Pameran)</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $card->title) }}" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                        @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- URL / Link Tujuan -->
                    <div>
                        <label for="target_url" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">URL / Link Alamat Tujuan</label>
                        <input type="text" name="target_url" id="target_url" value="{{ old('target_url', $card->target_url) }}" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm font-mono text-amber-800 focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">
                        @error('target_url') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Urutan Muncul & Gambar -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Urutan ... -->
                        <div class="md:col-span-1">
                            <label for="order_weight" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Urutan Tampil</label>
                            <input type="number" name="order_weight" id="order_weight" value="{{ old('order_weight', $card->order_weight) }}" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40 font-bold text-center">
                        </div>
                        <div class="md:col-span-2">
                            <label for="icon_or_image" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Ganti Gambar Banner</label>
                            <input type="file" name="icon_or_image" id="icon_or_image" class="w-full text-xs text-stone-500 border border-stone-200 rounded-xl bg-stone-50/40 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:text-xs file:font-bold file:bg-amber-100 file:text-amber-800">
                        </div>
                    </div>

                    @if($card->icon_or_image)
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Pratinjau Foto Saat Ini</label>
                            @php
                                $imgSrcCard = \Illuminate\Support\Str::startsWith($card->icon_or_image, 'http') 
                                    ? $card->icon_or_image 
                                    : (\Illuminate\Support\Str::startsWith($card->icon_or_image, 'images/') 
                                        ? asset($card->icon_or_image) 
                                        : (\Illuminate\Support\Str::startsWith($card->icon_or_image, 'storage/') 
                                            ? asset($card->icon_or_image) 
                                            : asset('storage/' . $card->icon_or_image)));
                            @endphp
                            <img id="image_preview_card" src="{{ $imgSrcCard }}" class="w-40 h-24 object-cover rounded-xl border border-stone-200 shadow-sm bg-stone-50">
                        </div>
                    @endif

                    <!-- Deskripsi Singkat -->
                    <div>
                        <label for="description" class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Deskripsi Keterangan Kartu</label>
                        <textarea name="description" id="description" rows="3" class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm focus:border-amber-500 focus:ring-amber-500 bg-stone-50/40">{{ old('description', $card->description) }}</textarea>
                    </div>

                    <div class="pt-4 border-t border-stone-100 flex gap-3">
                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow-sm transition">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.home-cards.index') }}" wire:navigate class="bg-stone-100 hover:bg-stone-200 text-stone-600 font-bold text-xs px-6 py-2.5 rounded-xl transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('icon_or_image')?.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('image_preview_card');
                    if (img) img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
