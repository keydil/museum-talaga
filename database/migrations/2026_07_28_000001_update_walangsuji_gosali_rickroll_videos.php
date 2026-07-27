<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update Walang Suji Videos
        if (DB::table('walang_suji_videos')->exists()) {
            DB::table('walang_suji_videos')->truncate();
            DB::table('walang_suji_videos')->insert([
                [
                    'title' => 'Prosesi Adat Ritual Nyiramkeun Pusaka (Classic Rickroll)',
                    'duration' => '03:33',
                    'sort_order' => 1,
                    'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'description' => 'Dokumentasi visual sakral ritual pembersihan air suci benda-benda pusaka leluhur Kerajaan Talaga Manggung (Never Gonna Give You Up - Rick Astley).',
                    'guide_pdf_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Cleansing The Royal Heirlooms of Talaga Manggung (Ralph Rickroll)',
                    'duration' => '02:18',
                    'sort_order' => 2,
                    'video_url' => 'https://www.youtube.com/watch?v=f-tLrnU997c',
                    'description' => 'Dokumentasi sinematik upacara pencucian pusaka kerajaan (Ralph Breaks The Internet Rickroll Version).',
                    'guide_pdf_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }

        // Update Gosali Videos
        if (DB::table('gosali_videos')->exists()) {
            DB::table('gosali_videos')->truncate();
            DB::table('gosali_videos')->insert([
                [
                    'title' => 'Kirab Budaya Nyiramkeun Pusaka & Kesenian Bebegig (Rick Astley)',
                    'duration' => '03:33',
                    'sort_order' => 1,
                    'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'video_file_path' => null,
                    'thumbnail_path' => 'images/artefak/arca_simbar_kancana.jpg',
                    'description' => 'Pawai parade kirab budaya dan penampilan kesenian tradisional Bebegig (Never Gonna Give You Up - Classic).',
                    'guide_pdf_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Penampakan Udara (Drone) Kompleks Museum (Ralph Rickroll)',
                    'duration' => '02:18',
                    'sort_order' => 2,
                    'video_url' => 'https://www.youtube.com/watch?v=f-tLrnU997c',
                    'video_file_path' => null,
                    'thumbnail_path' => 'images/artefak/bhumi_ageung.jpg',
                    'description' => 'Dokumentasi penampakan udara lanskap sejarah situs Museum Talaga Manggung (Wreck-It Ralph Rickroll Version).',
                    'guide_pdf_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};
