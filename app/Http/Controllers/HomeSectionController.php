<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
{
    public function index()
    {
        $sections = HomeSection::all()->keyBy('slug');

        return view('admin.beranda.index', compact('sections'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'cards_section_title' => 'nullable|string|max:255',
            'cards_section_description' => 'nullable|string|max:1000',
        ]);

        foreach ($data as $slug => $content) {
            HomeSection::updateOrCreate(
                ['slug' => $slug],
                ['content' => $content]
            );
        }

        return redirect()->route('admin.beranda.index')->with('success', 'Konten beranda berhasil diperbarui.');
    }
}
