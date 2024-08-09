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
        Schema::create('covers', function (Blueprint $table) {
            $table->id('cover_id');
            $table->smallInteger('cover_type_id')->unsigned();
            $table->tinyInteger('cover_status_id')->unsigned();
            $table->char('lang_id', 2)->default('uk');
            $table->string('title');
            // DB::statement('ALTER TABLE covers ADD COLUMN chapter_ids JSON NOT NULL DEFAULT (JSON_ARRAY()) AFTER lang_id');
            $table->json('chapter_ids')->default('[]');
            $table->text('description')->nullable();
            $table->string('img_key')->nullable();
            $table->boolean('public')->default(false);
            $table->integer('average_reading_time_sec')->default(0);
            $table->integer('words_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->integer('genre_id')->unsigned()->primary();
            $table->string('label');
        });

        Schema::create('chapters', function (Blueprint $table) {
            $table->id('chapter_id');
            $table->bigInteger('cover_id')->unsigned();
            $table->string('title');
            // DB::statement("ALTER TABLE chapters ADD COLUMN block_ids JSON NOT NULL DEFAULT (JSON_ARRAY()) AFTER word_count");
            $table->json('block_ids')->default('[]');
            $table->boolean('public')->default(false);
            $table->integer('word_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('blocks', function (Blueprint $table) {
            $table->char('block_nanoid_10', 10)->primary();

            $table->smallInteger('block_type_id')->unsigned();
            $table->json('data');
            $table->string('data_version', 10);
            $table->integer('word_count')->default(0);
            $table->timestamps();
        });

        Schema::create('block_types', function (Blueprint $table) {
            $table->smallInteger('block_type_id')->unsigned()->primary();
            $table->string('label', 100);
        });

        Schema::create('cover_types', function (Blueprint $table) {
            $table->smallInteger('cover_type_id')->unsigned()->primary();
            $table->string('label')->nullable(false);
        });

        Schema::create('cover_statuses', function (Blueprint $table) {
            $table->tinyInteger('cover_status_id')->primary()->unsigned();
            $table->string('label', 100);
        });

        Schema::create('language_codes', function (Blueprint $table) {
            $table->char('lang_id', 2)->primary();
            $table->string('label', 100);
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('cover_id')->unsigned();
            $table->unique(['user_id', 'cover_id']);
        });

        Schema::create('cover_genres', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cover_id')->unsigned();
            $table->integer('genre_id')->unsigned();
            $table->unique(['cover_id', 'genre_id']);
        });

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
            $table->dropForeign(['block_type_id']);
        });

        Schema::dropIfExists('covers');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('chapters');
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropUnique(['block_nanoid_10', 'chapter_id']);
        });
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('block_types');
        Schema::dropIfExists('cover_types');
        Schema::dropIfExists('cover_statuses');
        Schema::dropIfExists('language_codes');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('cover_genres');

    }
};
