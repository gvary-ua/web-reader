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
            $table->dropColumn('data_version');
        });
        Schema::table('blocks', function (Blueprint $table) {
            $table->string('data_version', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropColumn(['data_version']);
        });
        Schema::table('blocks', function (Blueprint $table) {
            $table->string('data_version', 10)
                ->virtualAs("JSON_UNQUOTE(JSON_EXTRACT(data, '$.version'))");
        });
    }
};
