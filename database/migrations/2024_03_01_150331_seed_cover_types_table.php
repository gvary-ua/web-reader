<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('cover_types')->insert([
            ['cover_type_id' => 1, 'label' => 'cover.types.book'],
            ['cover_type_id' => 2, 'label' => 'cover.types.completed'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DELETE FROM cover_types WHERE cover_type_id IN (1, 2)');
    }
};
