<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ShowCoverRequest;
use App\Http\Requests\Api\V1\UpdateCoverRequest;
use App\Http\Resources\V1\CoverResource;
use App\Models\Cover;

/**
 * @group Cover APIs
 *
 * APIs for managing covers.
 *
 * @authenticated
 */
class CoverController extends Controller
{
    /**
     * Get a cover by its ID.
     *
     * @urlParam id integer required The ID of the cover.
     */
    public function show(ShowCoverRequest $request)
    {
        $cover = Cover::where('cover_id', $request->cover_id)->first();

        return new CoverResource($cover);
    }

    /**
     * Update the specified resource in storage.
     *
     * @urlParam id integer required The ID of the cover.
     *
     * @bodyParam title string required The title of the cover.
     */
    public function update(UpdateCoverRequest $request)
    {
        $cover = Cover::where('cover_id', $request->cover_id)->first();

        $cover->update($request->only('title'));

        return new CoverResource($cover);
    }
}
