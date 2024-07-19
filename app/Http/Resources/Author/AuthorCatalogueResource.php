<?php

namespace App\Http\Resources\Author;

use App\Http\Resources\Book\PublishedBookResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorCatalogueResource extends JsonResource
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
            'message' => 'Successfully Show Author Catalogue.',
            'data' => [
                'id' => $this->author->id,
                'name' => $this->author->name,
                'bio' => $this->author->bio,
                'birth_date' => Carbon::parse($this->author->birth_date)->format('Y-m-d'),
                'books' => PublishedBookResource::collection($this->books)->response()->getData(true),
            ],
        ];
    }
}
