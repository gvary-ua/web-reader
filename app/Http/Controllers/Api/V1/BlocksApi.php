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

/**
 * @group Blocks APIs
 * 
 * APIs for creating and getting chapters.
 * 
 * @authenticated
 */
class BlocksApi extends Controller
{
    /**
     * Retrieve all blocks associated with a specific chapter.
     * 
     * @pathParam chapterId integer required The ID of the chapter this block is associated with.
     * @response 200 {
     *     "data": [
     *         {
     *             "id": "xlb4JE-i_B",
     *             "typeId": 1,
     *             "data": {
     *                 "text": "Hello world!",
     *                 "version": "1.0.0"
     *             }
     *         },
     *         {
     *             "id": "Q3H8zb0Mq6",
     *             "typeId": 1,
     *             "data": {
     *                 "text": "Hello!",
     *                 "version": "1.0.0"
     *             }
     *         },
     *         {
     *             "id": "md4023qhRg",
     *             "typeId": 1,
     *             "data": {
     *                 "text": "yes yes yes yes",
     *                 "version": "1.0.0"
     *             }
     *         },
     *         {
     *             "id": "ThmRYxu7LT",
     *             "typeId": 1,
     *             "data": {
     *                 "text": "nice beer realy",
     *                 "version": "1.0.0"
     *             }
     *         }
     *     ]
     * }
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
        $blocks = array_map(function ($block) {
            $block->data = json_decode($block->data);
            return $block;
        }, $blocks->all());

        return BlockResource::collection($blocks);
    }

    /**
     * Store multiple blocks for a specific chapter.
     * 
     * @pathParam chapterId integer required The ID of the chapter this block is associated with.
     * @response 200
     * @response 422 {"message":"The blocks.0.data.version field is required. (and 3 more errors)","errors":{"blocks.0.data.version":["The blocks.0.data.version field is required."],"blocks.1.data.version":["The blocks.1.data.version field is required."],"blocks.2.data.version":["The blocks.2.data.version field is required."],"blocks.3.data.version":["The blocks.3.data.version field is required."]}}
     */
    public function bulkStore(BulkStoreBlocksRequests $request)
    {
        $chapterId = $request->chapterId;

        $block_ids = collect($request->blocks)->map(function ($block) {
            return $block['block_nanoid_10'];
        })->toArray();

        $blocks = collect($request->blocks)->map(function ($block) {
            return Arr::except($block, ['id', 'typeId', 'wordCount']);
        })->toArray();

        DB::transaction(function () use ($chapterId, $block_ids, $blocks) {
            Chapter::where('chapter_id', $chapterId)
                ->update(['block_ids' => $block_ids]);
            Block::upsert($blocks, ['block_nanoid_10'], ['block_type_id', 'data', 'word_count']);
        });
    }
}
