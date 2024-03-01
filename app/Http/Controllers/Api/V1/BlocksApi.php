<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\BulkStoreBlocksRequests;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chapter;
use Illuminate\Support\Arr;

class BlocksApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bulkStore(BulkStoreBlocksRequests $request)
    {
        $chapterId = $request->chapterId;

        $block_ids = collect($request->blocks)->map(function($block) {
            return $block['block_nanoid_10'];
        })->toArray();
        
        $blocks = collect($request->blocks)->map(function($block) {
            return Arr::except($block, ['id', 'typeId', 'wordCount']);
        })->toArray();

        DB::transaction(function () use ($chapterId, $block_ids, $blocks) {
            Chapter::where('chapter_id', $chapterId)
                ->update(['block_ids' => $block_ids]);
            Block::upsert($blocks, ['block_nanoid_10'], ['block_type_id', 'data', 'word_count']);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block)
    {
        //
    }
}
