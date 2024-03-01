<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\IndexChapterRequest;
use App\Http\Requests\Api\V1\StoreChapterRequest;
use App\Http\Requests\Api\V1\UpdateChapterRequest;
use App\Http\Resources\V1\ChapterCollection;
use App\Http\Resources\V1\ChapterResource;
use App\Models\Chapter;

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
     */
    public function index(IndexChapterRequest $request)
    {
        return new ChapterCollection(Chapter::where('cover_id', $request->coverId)->get());
    }

    /**
     * Create a new chapter.
     * 
     * @bodyParam title string required The title of the chapter.
     * @bodyParam coverId integer required The ID of the cover this chapter is associated with.
     */
    public function store(StoreChapterRequest $request)
    {
        return new ChapterResource(Chapter::create($request->all()));
    }

    /**
     * Get a chapter by its ID.
     * 
     * @urlparam id integer required The ID of the chapter.
     */
    public function show(Chapter $chapter)
    {
        return new ChapterResource($chapter);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @urlparam id integer required The ID of the chapter.
     * @bodyParam title string required The title of the chapter.
     */
    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        $chapter->update($request->all());
    }

    /**
     * Deletes a chapter.
     * 
     * @urlparam id integer required The ID of the chapter.
     * @response 204
     */
    public function destroy(int $id)
    {
        $chapter = Chapter::find($id);
        if ($chapter) {
            $chapter->delete();
        }
        return response()->json(null, 204);
    }
}
