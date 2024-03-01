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
        DB::table('genres')->insert([
            ['genre_id' => 1, 'label' => 'genres.fantasy'],
            ['genre_id' => 2, 'label' => 'genres.science_fiction'],
            ['genre_id' => 3, 'label' => 'genres.post_apocalyptic'],
            ['genre_id' => 4, 'label' => 'genres.dystopia'],
            ['genre_id' => 5, 'label' => 'genres.cyberpunk'],
            ['genre_id' => 6, 'label' => 'genres.steampunk'],
            ['genre_id' => 7, 'label' => 'genres.solarpunk'],
            ['genre_id' => 8, 'label' => 'genres.alternative_history'],
            ['genre_id' => 9, 'label' => 'genres.fantasy'],
            ['genre_id' => 10, 'label' => 'genres.dark_fantasy'],
            ['genre_id' => 11, 'label' => 'genres.epic_fantasy'],
            ['genre_id' => 12, 'label' => 'genres.urban_fantasy'],
            ['genre_id' => 13, 'label' => 'genres.ethnic_fantasy'],
            ['genre_id' => 14, 'label' => 'genres.fairy_tale'],
            ['genre_id' => 15, 'label' => 'genres.horror'],
            ['genre_id' => 16, 'label' => 'genres.mystic'],
            ['genre_id' => 17, 'label' => 'genres.adventure'],
            ['genre_id' => 18, 'label' => 'genres.action'],
            ['genre_id' => 19, 'label' => 'genres.detective'],
            ['genre_id' => 20, 'label' => 'genres.thriller'],
            ['genre_id' => 21, 'label' => 'genres.space_fantasy'],
            ['genre_id' => 22, 'label' => 'genres.space_opera'],
            ['genre_id' => 23, 'label' => 'genres.social_fantasy'],
            ['genre_id' => 24, 'label' => 'genres.crypto_history'],
            ['genre_id' => 25, 'label' => 'genres.biopunk'],
            ['genre_id' => 26, 'label' => 'genres.superhero'],
            ['genre_id' => 27, 'label' => 'genres.historical_fantasy'],
            ['genre_id' => 28, 'label' => 'genres.cossack_fantasy'],
            ['genre_id' => 29, 'label' => 'genres.techno_fantasy'],
            ['genre_id' => 30, 'label' => 'genres.noir'],
            ['genre_id' => 31, 'label' => 'genres.neonoir'],
            ['genre_id' => 32, 'label' => 'genres.romance'],
            ['genre_id' => 33, 'label' => 'genres.modern_romance'],
            ['genre_id' => 34, 'label' => 'genres.romantic'],
            ['genre_id' => 35, 'label' => 'genres.erotic'],
            ['genre_id' => 36, 'label' => 'genres.free_verse'],
            ['genre_id' => 37, 'label' => 'genres.self_development'],
            ['genre_id' => 38, 'label' => 'genres.popular_science'],
            ['genre_id' => 39, 'label' => 'genres.legal_literature'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        for ($i = 1; $i <= 39; $i++) {
            DB::table('genres')->where('genre_id', $i)->delete();
        }
    }
};
