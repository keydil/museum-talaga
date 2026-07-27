<?php

namespace App\Http\Controllers;

use App\Models\WalangSujiVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WalangSujiController extends Controller
{
    public function index()
    {
        $videos = WalangSujiVideo::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.walangsuji.index', compact('videos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|string|max:20',
            'sort_order' => 'required|integer',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm|max:51200',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'guide_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('video_file')) {
            $validated['video_file_path'] = $request->file('video_file')->store('walangsuji/videos', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('walangsuji/thumbnails', 'public');
        }

        if ($request->hasFile('guide_pdf')) {
            $validated['guide_pdf_path'] = $request->file('guide_pdf')->store('walangsuji', 'public');
        }

        if (empty($validated['video_url']) && empty($validated['video_file_path'])) {
            $validated['video_url'] = 'https://www.w3schools.com/html/mov_bbb.mp4';
        }

        WalangSujiVideo::create($validated);

        return redirect()->route('admin.walangsuji.index')
            ->with('success', 'Konten Walang Suji berhasil disimpan.');
    }

    public function edit($id)
    {
        $video = WalangSujiVideo::findOrFail($id);

        return view('admin.walangsuji.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = WalangSujiVideo::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|string|max:20',
            'sort_order' => 'required|integer',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm|max:51200',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'guide_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('video_file')) {
            if ($video->video_file_path && Storage::disk('public')->exists($video->video_file_path)) {
                Storage::disk('public')->delete($video->video_file_path);
            }

            $validated['video_file_path'] = $request->file('video_file')->store('walangsuji/videos', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
                Storage::disk('public')->delete($video->thumbnail_path);
            }

            $validated['thumbnail_path'] = $request->file('thumbnail')->store('walangsuji/thumbnails', 'public');
        }

        if ($request->hasFile('guide_pdf')) {
            if ($video->guide_pdf_path && Storage::disk('public')->exists($video->guide_pdf_path)) {
                Storage::disk('public')->delete($video->guide_pdf_path);
            }

            $validated['guide_pdf_path'] = $request->file('guide_pdf')->store('walangsuji', 'public');
        }

        if (empty($validated['video_url'])) {
            $validated['video_url'] = $video->video_url;
        }

        $video->update($validated);

        return redirect()->route('admin.walangsuji.index')
            ->with('success', 'Konten Walang Suji berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $video = WalangSujiVideo::findOrFail($id);

        if ($video->video_file_path && Storage::disk('public')->exists($video->video_file_path)) {
            Storage::disk('public')->delete($video->video_file_path);
        }

        if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
            Storage::disk('public')->delete($video->thumbnail_path);
        }

        if ($video->guide_pdf_path && Storage::disk('public')->exists($video->guide_pdf_path)) {
            Storage::disk('public')->delete($video->guide_pdf_path);
        }

        $video->delete();

        return redirect()->route('admin.walangsuji.index')
            ->with('success', 'Konten Walang Suji berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $ids = $request->input('ids', []);

        foreach ($ids as $index => $id) {
            WalangSujiVideo::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
