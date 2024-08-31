<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // TODO: Add other fields if needed
        return [
            'id' => $this->cover_id,
            'title' => $this->title,
            'public' => $this->public,
            'coverType' => $this->coverType->cover_type_id,
        ];
    }
}
