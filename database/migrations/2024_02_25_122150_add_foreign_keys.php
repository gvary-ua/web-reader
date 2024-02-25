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
        Schema::table('authors', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('cover_id')->references('cover_id')->on('covers')->onDelete('cascade');
        });

        Schema::table('cover_genres', function (Blueprint $table) {
            $table->foreign('cover_id')->references('cover_id')->on('covers')->onDelete('cascade');
            $table->foreign('genre_id')->references('genre_id')->on('genres')->onDelete('cascade');
        });

        Schema::table('covers', function (Blueprint $table) {
            $table->foreign('cover_type_id')->references('cover_type_id')->on('cover_types');
            $table->foreign('cover_status_id')->references('cover_status_id')->on('cover_statuses');
            $table->foreign('lang_id')->references('lang_id')->on('language_codes');
        });

        Schema::table('chapters', function (Blueprint $table) {
            $table->foreign('cover_id')->references('cover_id')->on('covers')->onDelete('cascade');
        });

        Schema::table('blocks', function (Blueprint $table) {
            $table->foreign('chapter_id')->references('chapter_id')->on('chapters');
            $table->foreign('block_type_id')->references('block_type_id')->on('block_types');
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

        Schema::table('covers', function (Blueprint $table) {
            $table->dropForeign(['cover_type_id']);
            $table->dropForeign(['cover_status_id']);
            $table->dropForeign(['lang_id']);
        });

        Schema::table('chapters', function (Blueprint $table) {
            $table->dropForeign(['cover_id']);
        });

        Schema::table('blocks', function (Blueprint $table) {
            $table->dropForeign(['chapter_id']);
            $table->dropForeign(['block_type_id']);
        });
    }
};
