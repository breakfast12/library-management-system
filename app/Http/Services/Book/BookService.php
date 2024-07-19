<?php

namespace App\Http\Services\Book;

use App\Repositories\Contracts\Book\BookContract;

class BookService
{
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

        // Retrieve books from the repository with filters.
        return $this->repository->getBooks(
            $search,
            $publishDateFrom,
            $publishDateTo,
            $orderBy,
            $order,
            $perPage,
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
        // Use the repository to store the book.
        return $this->repository->store($request);
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
        // Use the repository to update the book.
        return $this->repository->update($attributes, $id);
    }

    /**
     * Delete book by ID.
     *
     * @param int
     * @return int
     */
    public function deleteService($id)
    {
        // Use the repository to delete the book.
        return $this->repository->delete($id);
    }
}
