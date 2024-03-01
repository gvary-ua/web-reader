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
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropForeign(['chapter_id']);
            $table->dropColumn(['block_id', 'chapter_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->bigInteger('chapter_id')->unsigned();
            $table->string('block_id', 20)
                ->primary()
                ->storedAs("CONCAT(chapter_id, '-', block_nanoid_10)");
            $table->foreign('chapter_id')->references('chapter_id')->on('chapters');
        });
    }
};
