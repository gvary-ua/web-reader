<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DELETE FROM block_types WHERE block_type_id IN (6, 7)');

        DB::table('block_types')->where('block_type_id', 1)->update(['label' => 'block.types.header']);
        DB::table('block_types')->where('block_type_id', 2)->update(['label' => 'block.types.paragraph']);
        DB::table('block_types')->where('block_type_id', 3)->update(['label' => 'block.types.list']);
        DB::table('block_types')->where('block_type_id', 4)->update(['label' => 'block.types.checkList']);
        DB::table('block_types')->where('block_type_id', 5)->update(['label' => 'block.types.delimiter']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        DB::table('block_types')->where('block_type_id', 1)->update(['label' => 'block.types.paragraph']);
        DB::table('block_types')->where('block_type_id', 2)->update(['label' => 'block.types.header']);
        DB::table('block_types')->where('block_type_id', 3)->update(['label' => 'block.types.list']);
        DB::table('block_types')->where('block_type_id', 4)->update(['label' => 'block.types.table']);
        DB::table('block_types')->where('block_type_id', 5)->update(['label' => 'block.types.delimiter']);

        DB::table('block_types')->insert([
            ['block_type_id' => 6, 'label' => 'block.types.image'],
            ['block_type_id' => 7, 'label' => 'block.types.quote'],
        ]);
    }
};
