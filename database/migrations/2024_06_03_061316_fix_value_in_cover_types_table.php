<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('cover_types')
            ->where('cover_type_id', 2)
            ->update(['label' => 'cover.types.verse']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('cover_types')
            ->where('cover_type_id', 2)
            ->update(['label' => 'cover.types.completed']);
    }
};
