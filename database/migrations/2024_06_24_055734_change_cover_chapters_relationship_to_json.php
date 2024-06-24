<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE covers ADD COLUMN chapter_ids JSON NOT NULL DEFAULT (JSON_ARRAY()) AFTER lang_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE covers DROP COLUMN chapter_ids');
    }
};
