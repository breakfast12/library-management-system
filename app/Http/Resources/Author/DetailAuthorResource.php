<?php

namespace App\Http\Resources\Author;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailAuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'message' => 'Successfully Show Detail Author.',
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'bio' => $this->bio,
                'birth_date' => Carbon::parse($this->birth_date)->format('Y-m-d'),
                'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
                'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
            ],
        ];
    }
}
