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
}
