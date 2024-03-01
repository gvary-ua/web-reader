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
        DB::table('block_types')->insert([
            ['block_type_id' => 1, 'label' => 'block.types.paragraph'],
            ['cover_type_id' => 2, 'label' => 'block.types.header'],
            ['block_type_id' => 3, 'label' => 'block.types.list'],
            ['block_type_id' => 4, 'label' => 'block.types.table'],
            ['block_type_id' => 5, 'label' => 'block.types.delimiter'],
            ['block_type_id' => 6, 'label' => 'block.types.image'],
            ['block_type_id' => 7, 'label' => 'block.types.quote']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DELETE FROM block_types WHERE block_type_id IN (1, 2, 3, 4, 5, 6, 7)');
    }
};
