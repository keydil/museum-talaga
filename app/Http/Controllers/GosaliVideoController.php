<?php

namespace App\Http\Controllers;

use App\Models\GosaliVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GosaliVideoController extends Controller
{
    public function index()
    {
        $videos = GosaliVideo::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.gosali.index', compact('videos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|string|max:20',
            'sort_order' => 'required|integer',
            'source_type' => 'nullable|string|in:youtube,file',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm|max:102400',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'guide_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $sourceType = $request->input('source_type', 'youtube');

        if ($sourceType === 'file' && $request->hasFile('video_file')) {
            $validated['video_file_path'] = $request->file('video_file')->store('gosali/videos', 'public');
            $validated['video_url'] = null;
        } else {
            $validated['video_file_path'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('gosali/thumbnails', 'public');
        }

        if ($request->hasFile('guide_pdf')) {
            $validated['guide_pdf_path'] = $request->file('guide_pdf')->store('gosali', 'public');
        }

        if (empty($validated['video_url']) && empty($validated['video_file_path'])) {
            $validated['video_url'] = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
        }

        GosaliVideo::create($validated);

        return redirect()->route('admin.gosali.index')->with('success', 'Konten Gosali berhasil disimpan.');
    }

    public function edit($id)
    {
        $video = GosaliVideo::findOrFail($id);

        return view('admin.gosali.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = GosaliVideo::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|string|max:20',
            'sort_order' => 'required|integer',
            'source_type' => 'nullable|string|in:youtube,file',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm|max:102400',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'guide_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $sourceType = $request->input('source_type', ($video->video_file_path ? 'file' : 'youtube'));

        if ($sourceType === 'file') {
            if ($request->hasFile('video_file')) {
                if ($video->video_file_path && Storage::disk('public')->exists($video->video_file_path)) {
                    Storage::disk('public')->delete($video->video_file_path);
                }
                $validated['video_file_path'] = $request->file('video_file')->store('gosali/videos', 'public');
            } else {
                $validated['video_file_path'] = $video->video_file_path;
            }
            $validated['video_url'] = null;
        } else {
            if ($video->video_file_path && Storage::disk('public')->exists($video->video_file_path)) {
                Storage::disk('public')->delete($video->video_file_path);
            }
            $validated['video_file_path'] = null;
            $validated['video_url'] = !empty($validated['video_url']) ? $validated['video_url'] : $video->video_url;
        }

        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
                Storage::disk('public')->delete($video->thumbnail_path);
            }
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('gosali/thumbnails', 'public');
        }

        if ($request->hasFile('guide_pdf')) {
            if ($video->guide_pdf_path && Storage::disk('public')->exists($video->guide_pdf_path)) {
                Storage::disk('public')->delete($video->guide_pdf_path);
            }
            $validated['guide_pdf_path'] = $request->file('guide_pdf')->store('gosali', 'public');
        }

        $video->update($validated);

        return redirect()->route('admin.gosali.index')->with('success', 'Konten Gosali berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $video = GosaliVideo::findOrFail($id);

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

        return redirect()->route('admin.gosali.index')->with('success', 'Konten Gosali berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $ids = $request->input('ids', []);

        foreach ($ids as $index => $id) {
            GosaliVideo::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
