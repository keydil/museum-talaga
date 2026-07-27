<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            DB::statement("ALTER TABLE walang_suji_videos MODIFY COLUMN video_url VARCHAR(255) NULL");
        } catch (\Throwable $e) {}

        try {
            DB::statement("ALTER TABLE gosali_videos MODIFY COLUMN video_url VARCHAR(255) NULL");
        } catch (\Throwable $e) {}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            DB::statement("ALTER TABLE walang_suji_videos MODIFY COLUMN video_url VARCHAR(255) NOT NULL");
        } catch (\Throwable $e) {}

        try {
            DB::statement("ALTER TABLE gosali_videos MODIFY COLUMN video_url VARCHAR(255) NOT NULL");
        } catch (\Throwable $e) {}
    }
};
