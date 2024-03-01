<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('cover_statuses')->insert([
            ['cover_status_id' => 1, 'label' => 'cover.statuses.in_progress'],
            ['cover_status_id' => 2, 'label' => 'cover.statuses.completed'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DELETE FROM cover_statuses WHERE cover_status_id IN (1, 2)');
    }
};
