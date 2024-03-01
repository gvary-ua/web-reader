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
        DB::table('language_codes')->insert([
            ['lang_id' => 'uk', 'label' => 'languages.ukrainian'],
            ['lang_id' => 'en', 'label' => 'languages.english'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DELETE FROM language_codes WHERE lang_id IN ("uk", "en")');
    }
};
