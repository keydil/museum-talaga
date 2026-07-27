<x-app-layout>
    <div class="min-h-screen bg-[#fdfbf2] py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.gosali.index') }}" class="text-sm font-semibold text-amber-700">← Kembali ke daftar</a>
                <h1 class="mt-2 font-serif text-3xl font-bold text-stone-900">Edit Konten Gosali</h1>
            </div>

            <div class="rounded-2xl border border-amber-200/60 bg-white p-6 shadow-sm">
                <form action="{{ route('admin.gosali.update', $video->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm text-stone-700" onsubmit="handleFormSubmit(this)">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="mb-1 block font-semibold text-stone-700">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $video->title) }}" class="w-full rounded-lg border border-stone-200 px-3 py-2" required>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block font-semibold text-stone-700">Durasi</label>
                            <input type="text" name="duration" value="{{ old('duration', $video->duration) }}" class="w-full rounded-lg border border-stone-200 px-3 py-2" required>
                        </div>
                        <div>
                            <label class="mb-1 block font-semibold text-stone-700">Urutan Putar</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $video->sort_order) }}" class="w-full rounded-lg border border-stone-200 px-3 py-2" required>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold text-stone-700">Option 1: URL Video YouTube</label>
                        <input type="url" name="video_url" value="{{ old('video_url', $video->video_url) }}" class="w-full rounded-lg border border-stone-200 px-3 py-2">
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold text-stone-700">Option 2: Upload File Video MP4 (Ganti File MP4)</label>
                        <input type="file" name="video_file" accept="video/mp4,video/webm,video/quicktime" class="w-full rounded-lg border border-stone-200 px-3 py-2 text-xs">
                        @if($video->video_file_path)
                            <p class="mt-1 text-xs text-stone-500">File MP4 saat ini: <span class="font-mono text-amber-800">{{ $video->video_file_path }}</span></p>
                        @endif
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold text-stone-700">Thumbnail Video (opsional)</label>
                        <input type="file" name="thumbnail" accept="image/*" class="w-full rounded-lg border border-stone-200 px-3 py-2 text-xs">
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold text-stone-700">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full rounded-lg border border-stone-200 px-3 py-2" required>{{ old('description', $video->description) }}</textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold text-stone-700">Lampiran PDF (opsional)</label>
                        <input type="file" name="guide_pdf" accept="application/pdf" class="w-full rounded-lg border border-stone-200 px-3 py-2">
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <a href="{{ route('admin.gosali.index') }}" class="rounded-lg border border-stone-200 px-4 py-2 font-semibold text-stone-700">Batal</a>
                        <button type="submit" id="btnSubmit" class="flex items-center gap-2 rounded-lg bg-amber-700 px-5 py-2.5 font-semibold text-white transition hover:bg-amber-800 disabled:opacity-50">
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function handleFormSubmit(form) {
            const btn = document.getElementById('btnSubmit');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span>Sedang Mengunggah File... Mohon Tunggu</span>';
            }
        }
    </script>
</x-app-layout>
