<?php

namespace App\Http\Controllers;

use App\Models\HomeCard;
use App\Models\GosaliVideo;
use App\Models\Position;
use App\Models\Visimisi;
use App\Models\WalangSujiVideo;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function index()
    {
        $homeCards = HomeCard::orderBy('order_weight', 'asc')->get();
        $cardsSectionTitle = \App\Models\HomeSection::value('cards_section_title', 'Koleksi Unggulan');
        $cardsSectionDescription = \App\Models\HomeSection::value('cards_section_description', 'Pilih bagian yang ingin Anda jelajahi dari halaman beranda ini.');

        return view('welcome', compact(
            'homeCards',
            'cardsSectionTitle',
            'cardsSectionDescription'
        ));
    }

    public function kegiatan()
    {
        return view('kegiatan'); // Mengarah ke views/profil.blade.php
    }

    public function berita()
    {
        return view('berita'); // Mengarah ke views/berita.blade.php
    }

    public function galeri()
    {
        return view('galeri'); // Mengarah ke views/galeri.blade.php
    }

    public function sejarah()
{
    try {
        // Mencoba mengambil data dengan kolom standar 'content'
        $sejarahData = \DB::table('sections')
            ->where('page', 'sejarah')
            ->pluck('content', 'key')
            ->toArray();
    } catch (\Exception $e) {
        // Fallback: Jika kolom 'content' tidak ada, coba pakai kolom 'isi' atau kembalikan array kosong
        try {
            $sejarahData = \DB::table('sections')
                ->where('page', 'sejarah')
                ->pluck('isi', 'key')
                ->toArray();
        } catch (\Exception $ex) {
            $sejarahData = [];
        }
    }

    return view('sejarah', compact('sejarahData'));
}


    public function visimisi()
    {
        $visimisi = Visimisi::first();

        $visimisiData = $visimisi ? [
            'visimisi_title' => $visimisi->title,
            'visimisi_subtitle' => $visimisi->subtitle,
            'visimisi_image' => $visimisi->image,
            'visimisi_visi' => $visimisi->visi,
            'visimisi_misi' => $visimisi->misi,
        ] : [];

        return view('visimisi', compact('visimisiData'));
    }

public function strukturorg()
{
    // KOREKSI UTAMA: Ambil data tunggal bermerek 'Global' dari database
    $struktur = Position::where('title', 'Global')->first();

    // Lempar variabel $struktur ke dalam file Blade publik Anda
    return view('strukturorg', compact('struktur'));
}


    public function walangsuji()
    {
        $videos = WalangSujiVideo::orderBy('sort_order')->orderBy('id')->get();

        return view('walangsuji', compact('videos'));
    }

    public function gosali()
    {
        $videos = GosaliVideo::orderBy('sort_order')->orderBy('id')->get();

        return view('gosali', compact('videos'));
    }
}
