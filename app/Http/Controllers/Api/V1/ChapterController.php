<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\IndexChapterRequest;
use App\Http\Requests\Api\V1\StoreChapterRequest;
use App\Http\Requests\Api\V1\UpdateChapterRequest;
use App\Http\Resources\V1\ChapterCollection;
use Illuminate\Http\Request;
use App\Http\Resources\V1\ChapterResource;
use App\Models\Chapter;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexChapterRequest $request)
    {
        return new ChapterCollection(Chapter::where('cover_id', $request->coverId)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChapterRequest $request)
    {
        return new ChapterResource(Chapter::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        return new ChapterResource($chapter);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        $chapter->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
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
