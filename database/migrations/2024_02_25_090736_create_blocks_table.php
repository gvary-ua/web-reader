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
        Schema::create('blocks', function (Blueprint $table) {
            $table->char('block_nanoid_10', 10);
            $table->bigInteger('chapter_id')->unsigned();
            $table->string('block_id', 20)
                ->primary()
                ->storedAs("CONCAT(chapter_id, '-', block_nanoid_10)");

            $table->smallInteger('block_type_id')->unsigned();
            $table->json('data');
            $table->string('data_version', 10)
                ->virtualAs("JSON_UNQUOTE(JSON_EXTRACT(data, '$.version'))");
            $table->integer('word_count')->default(0);
            $table->timestamps();

            $table->unique(['block_nanoid_10', 'chapter_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropUnique(['block_nanoid_10', 'chapter_id']);
        });
        Schema::dropIfExists('blocks');
    }
};
