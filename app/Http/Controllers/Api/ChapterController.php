<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use Illuminate\Support\Facades\Validator;

/**
 * @group Chapters
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
     * @queryParam cover_id integer required The ID of the cover this chapter is associated with.
     */
    public function index(Request $request)
    {
        $valid = $request->validate([
            'cover_id' => 'required|exists:covers,cover_id'
        ]);
        return Chapter::where('cover_id', $valid['cover_id'])->get();
    }

    /**
     * Create a new chapter.
     * 
     * @bodyParam title string required The title of the chapter.
     * @bodyParam cover_id integer required The ID of the cover this chapter is associated with.
     */
    public function store(Request $request)
    {
        if (!$request->isJson()) {
            return response()->json(['message' => 'Request must be JSON'], 415);
        }

        $content = $request->getContent(false);
        $data = json_decode($content, true);

        $rules = [
            'title' => 'required',
            'cover_id' => 'required|exists:covers,cover_id'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $validated = $validator->validated();
            $chapter = Chapter::create($validated);

            return response()->json($chapter, 201);
        } else {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }
    }

    /**
     * Get a chapter by its ID.
     * 
     * @urlparam id integer required The ID of the chapter.
     */
    public function show(string $id)
    {
        return Chapter::where('chapter_id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     * 
     * @urlparam id integer required The ID of the chapter.
     * @bodyParam title string required The title of the chapter.
     * @response status=200 scenario=success {
     *  "chapter_id": 1,
     *  "cover_id": 4,
     *  "title": "chapter one",
     *  "public": false,
     *  "word_count": 0,
     *  "published_at": null,
     *  "created_at": "2024-02-27T13:54:03.000000Z",
     *  "updated_at": "2024-02-27T13:54:03.000000Z"
     * }
     * 
     * @response status=400 scenario="Validation failed" {
     *  "message": "Validation failed",
     *  "errors": []
     * }
     * 
     * @response status=404 scenario="Chapter not found" {
     *  "message": "Chapter not found"
     * }
     * 
     * @response status=415 scenario="Request must be JSON" {
     *  "message": "Request must be JSON"
     * }
     */
    public function update(Request $request, string $id)
    {
        if (!$request->isJson()) {
            return response()->json(['message' => 'Request must be JSON'], 415);
        }

        $content = $request->getContent(false);
        $data = json_decode($content, true);

        $rules = [
            'title' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $chapter = Chapter::find($id);
            if (!$chapter) {
                return response()->json(['message' => 'Chapter not found'], 404);
            }

            $validated = $validator->validated();
            $chapter->update($validated);

            return response()->json($chapter);
        } else {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }
    }

    /**
     * Deletes a chapter.
     * 
     * @urlparam id integer required The ID of the chapter.
     * @response 204 {}
     */
    public function destroy(string $id)
    {
        $chapter = Chapter::find($id);
        if ($chapter) {
            $chapter->delete();
        }
        return response()->json(null, 204);
    }
}
