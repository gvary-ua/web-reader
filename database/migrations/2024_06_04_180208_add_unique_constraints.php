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
        Schema::table('authors', function (Blueprint $table) {
            $table->unique(['user_id', 'cover_id']);
        });

        Schema::table('cover_genres', function (Blueprint $table) {
            $table->unique(['cover_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['cover_id']);
        });
        Schema::table('cover_genres', function (Blueprint $table) {
            $table->dropForeign(['cover_id']);
            $table->dropForeign(['genre_id']);
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'cover_id']);
        });

        Schema::table('cover_genres', function (Blueprint $table) {
            $table->dropUnique(['cover_id', 'genre_id']);
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('cover_id')->references('cover_id')->on('covers')->onDelete('cascade');
        });
        Schema::table('cover_genres', function (Blueprint $table) {
            $table->foreign('cover_id')->references('cover_id')->on('covers')->onDelete('cascade');
            $table->foreign('genre_id')->references('genre_id')->on('genres')->onDelete('cascade');
        });
    }
};
