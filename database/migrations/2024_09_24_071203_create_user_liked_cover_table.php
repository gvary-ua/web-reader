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
        Schema::create('user_liked_cover', function (Blueprint $table) {
            $table->id('like_id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('cover_id')->unsigned();
            $table->timestamps();
            $table->unique(['user_id', 'cover_id']);
        });

        Schema::table('user_liked_cover', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('cover_id')->references('cover_id')->on('covers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_liked_cover', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['cover_id']);
        });

        Schema::dropIfExists('user_liked_cover');
    }
};
