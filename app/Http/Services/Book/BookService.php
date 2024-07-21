<?php

namespace App\Http\Services\Book;

use App\Http\Traits\FlushCacheTrait;
use App\Repositories\Contracts\Book\BookContract;
use Illuminate\Support\Facades\DB;

class BookService
{
    use FlushCacheTrait;

    /**
     * The book repository instance.
     *
     * @var BookContract
     */
    protected $repository;

    /**
     * Constructor to initialize the repository.
     *
     * @param BookContract
     */
    public function __construct(BookContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of books based on filters and pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function indexService()
    {
        // Get search and filter parameters from the request.
        $search = request('search');
        $publishDateFrom = request('publish_date_from');
        $publishDateTo = request('publish_date_to');
        $orderBy = request('order_by', 'created_at');
        $order = request('order', 'desc');
        $perPage = request('per_page', 10);
        $page = request('page', 1);

        // Retrieve books from the repository with filters.
        return $this->repository->getBooks(
            $search,
            $publishDateFrom,
            $publishDateTo,
            $orderBy,
            $order,
            $perPage,
            $page,
        );
    }

    /**
     * Store a new book.
     *
     * @param array
     * @return mixed
     */
    public function storeService(array $request)
    {
        $book = DB::transaction(function () use ($request) {
            // Use the repository to store the book.
            return $this->repository->store($request);
        });

        // Flush multiple cache tags
        $this->flushCache([
            'books',
            "author_{$book->author_id}",
            "books_author_{$book->author_id}",
        ]);

        return $book;
    }

    /**
     * Find book with author by book id.
     *
     * @param int
     * @return mixed
     */
    public function findService($id)
    {
        // Use the repository to find the book.
        return $this->repository->findWithAuthor($id);
    }

    /**
     * Update existing book.
     *
     * @param array
     * @param int
     * @return int
     */
    public function updateService(array $attributes, $id)
    {
        // Retrieve the current author_id before updating
        $currentAuthorId = $this->repository->find($id)->author_id;

        $book = DB::transaction(function () use ($attributes, $id) {
            // Use the repository to update the book.
            return $this->repository->update($attributes, $id);
        });

        // Retrieve the new author_id after updating
        $newAuthorId = $attributes['author_id'];

        // Flush multiple cache tags
        $this->flushCache([
            'books',
            "author_{$currentAuthorId}",
            "books_author_{$currentAuthorId}",
            "author_{$newAuthorId}",
            "books_author_{$newAuthorId}",
        ]);

        return $book;
    }

    /**
     * Delete book by ID.
     *
     * @param int
     * @return int
     */
    public function deleteService($id)
    {
        $authorId = $this->repository->find($id)->author_id;

        $book = DB::transaction(function () use ($id) {
            // Use the repository to delete the book.
            return $this->repository->delete($id);
        });

        // Flush multiple cache tags
        $this->flushCache([
            'books',
            "author_{$authorId}",
            "books_author_{$authorId}",
        ]);

        return $book;
    }
}
