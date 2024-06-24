<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\DeleteChapterRequest;
use App\Http\Requests\Api\V1\IndexChapterRequest;
use App\Http\Requests\Api\V1\ShowChapterRequest;
use App\Http\Requests\Api\V1\StoreChapterRequest;
use App\Http\Requests\Api\V1\UpdateChapterRequest;
use App\Http\Resources\V1\ChapterCollection;
use App\Http\Resources\V1\ChapterResource;
use App\Models\Chapter;
use App\Models\Cover;
use Illuminate\Support\Facades\DB;

/**
 * @group Chapters APIs
 *
 * APIs for managing chapters.
 *
 * @authenticated
 */
class ChapterController extends Controller
{
    /**
     * Retrieve all chapters associated with a specific cover.
     *
     * @queryParam coverId integer required The ID of the cover this chapter is associated with.
     *
     * @response 200 {"data":[{"id":1,"title":"New book 1","public":false,"blockIds":[]},{"id":2,"title":"new Book 2","public":false,"blockIds":[]},{"id":3,"title":"new 3","public":true,"blockIds":[]},{"id":8,"title":"new chapter yes","public":false,"blockIds":[]},{"id":9,"title":"new chapter yes","public":false,"blockIds":[]},{"id":10,"title":"new chapter yes","public":false,"blockIds":[]},{"id":11,"title":"new chapter yes","public":false,"blockIds":[]},{"id":12,"title":"new chapter yes","public":false,"blockIds":[]}]}
     * @response 404 {"message":"The selected cover id is invalid.","errors":{"coverId":["The selected cover id is invalid."]}}
     */
    public function index(IndexChapterRequest $request)
    {
        $cover = Cover::where('cover_id', $request->coverId)->first();

        return new ChapterCollection($cover->chapters());
    }

    /**
     * Append a new chapter to the end of an array.
     *
     * @bodyParam title string required The title of the chapter.
     * @bodyParam coverId integer required The ID of the cover this chapter is associated with.
     */
    public function store(StoreChapterRequest $request)
    {
        $chapter = DB::transaction(function () use ($request) {
            $cover = Cover::where('cover_id', $request->cover_id)->first();
            $chapter = Chapter::create($request->all());
            $cover->appendChapter($chapter);
            $cover->save();

            return $chapter;
        });

        return new ChapterResource($chapter);
    }

    /**
     * Get a chapter by its ID.
     *
     * @urlParam id integer required The ID of the chapter.
     *
     * @response 200 {"data":{"id":12,"title":"new chapter yes","public":false,"blockIds":[]}}
     * @response 404 {"message":"The selected chapter id is invalid.","errors":{"chapter_id":["The selected chapter id is invalid."]}}
     */
    public function show(ShowChapterRequest $request)
    {
        $chapter = Chapter::where('chapter_id', $request->chapter_id)->first();

        return new ChapterResource($chapter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @urlParam id integer required The ID of the chapter.
     *
     * @bodyParam title string required The title of the chapter.
     *
     * @response 200
     * @response 422 {"message":"The selected blockIds.0 is invalid.","errors":{"blockIds.0":["The selected blockIds.0 is invalid."]}}
     * @response 422 {"message":"The block ids field must be an array.","errors":{"blockIds":["The block ids field must be an array."]}}
     */
    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        $chapter->update($request->all());
    }

    /**
     * Deletes a chapter.
     *
     * @urlParam id integer required The ID of the chapter.
     *
     * @response 204
     * @response 422 {"message":"The selected chapter id is invalid.","errors":{"chapter_id":["The selected chapter id is invalid."]}}
     */
    public function destroy(DeleteChapterRequest $request)
    {

        DB::transaction(function () use ($request) {
            $chapter = Chapter::where('chapter_id', $request->chapter_id)->first();

            $cover = $chapter->cover;
            $cover->removeChapter($chapter);
            $cover->save();

            $chapter->delete();
        });

        return response()->json(null, 204);
    }
}
