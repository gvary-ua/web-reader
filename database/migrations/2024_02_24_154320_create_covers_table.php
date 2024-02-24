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
            $table->text('description')->nullable();
            $table->string('img_key');
            $table->boolean('public')->default(false);
            $table->integer('average_reading_time_sec')->default(0);
            $table->integer('words_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covers');
    }
};
