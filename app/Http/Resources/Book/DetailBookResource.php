<?php

namespace App\Http\Resources\Book;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailBookResource extends JsonResource
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
            'message' => 'Successfully Show Detail Book.',
            'data' => [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'publish_date' => Carbon::parse($this->publish_date)->format('Y-m-d'),
                'author' => [
                    'id' => $this->author->id,
                    'name' => $this->author->name,
                ],
                'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
                'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
            ],
        ];
    }
}
