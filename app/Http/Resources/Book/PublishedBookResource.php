<?php

namespace App\Http\Resources\Book;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublishedBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'publish_date' => Carbon::parse($this->publish_date)->format('Y-m-d'),
        ];
    }
}
