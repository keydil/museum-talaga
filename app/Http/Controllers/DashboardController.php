<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\WalangSujiVideo;
use App\Models\GosaliVideo;
use App\Models\PageView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Calculate Real Visitor Data for current week (Mon-Sun)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $visitorCounts = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i)->toDateString();
            
            if (Schema::hasTable('page_views')) {
                $count = PageView::where('view_date', $date)->count();
            } else {
                $count = 0;
            }
            
            $visitorCounts[] = $count;
        }

        // Total visitor statistics
        $totalViews = Schema::hasTable('page_views') ? PageView::count() : 0;
        $todayViews = Schema::hasTable('page_views') ? PageView::where('view_date', now()->toDateString())->count() : 0;

        // 2. Real Content Distribution Data
        $totalBerita = class_exists(Berita::class) ? Berita::count() : 0;
        $totalGaleri = class_exists(Galeri::class) ? Galeri::count() : 0;
        $totalWalangSuji = class_exists(WalangSujiVideo::class) ? WalangSujiVideo::count() : 0;
        $totalGosali = class_exists(GosaliVideo::class) ? GosaliVideo::count() : 0;
        $totalVideo = $totalWalangSuji + $totalGosali;

        $contentDistribution = [
            'berita' => $totalBerita,
            'galeri' => $totalGaleri,
            'video'  => $totalVideo,
        ];

        return view('admin.dashboard', compact(
            'days',
            'visitorCounts',
            'totalViews',
            'todayViews',
            'contentDistribution'
        ));
    }
}
