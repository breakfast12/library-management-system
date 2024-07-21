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
        // Convert the books collection to a PublishedBookResource collection
        $booksResource = PublishedBookResource::collection($this->books);

        // Get the paginated books data in array format
        $paginatedBooks = $booksResource->response($request)->getData(true);

        // Get the total number of books
        $totalBooks = $this->books->total();

        // Add the total books count to the meta information in the paginated data
        $paginatedBooks['meta']['total_books'] = $totalBooks;

        // Return the response array
        return [
            'status' => 'success',
            'message' => 'Successfully Show Author Catalogue.',
            'data' => [
                'id' => $this->author->id,
                'name' => $this->author->name,
                'bio' => $this->author->bio,
                'birth_date' => Carbon::parse($this->author->birth_date)->format('Y-m-d'),
                'books' => $paginatedBooks,
            ],
        ];
    }
}
