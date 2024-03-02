<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\BulkStoreBlocksRequests;
use App\Http\Requests\Api\V1\IndexBlocksRequest;
use App\Http\Resources\V1\BlockResource;
use App\Models\Block;
use Illuminate\Support\Facades\DB;
use App\Models\Chapter;
use Illuminate\Support\Arr;

class BlocksApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexBlocksRequest $request)
    {
        $chapterId = $request->chapterId;

        $block_ids = Chapter::where('chapter_id', $chapterId)
            ->first()
            ->block_ids;

        $blocks = Block::whereIn('block_nanoid_10', $block_ids)
            ->orderByRaw('FIELD(block_nanoid_10, "' . implode('","', $block_ids) . '")')
            ->get();

        // Decode the JSON string into JSON object
        $blocks = array_map(function($block) {
            $block->data = json_decode($block->data);
            return $block;
        }, $blocks->all());

        return BlockResource::collection($blocks);
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
}
