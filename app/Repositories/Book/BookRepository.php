<?php

namespace App\Repositories\Book;

use App\Models\Book\Book;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\Book\BookContract;

class BookRepository extends BaseRepository implements BookContract
{
    /**
     * The book model instance.
     *
     * @var Book
     */
    protected $book;

    /**
     * Constructor for BookRepository and call parent constructor.
     *
     * @param Book
     */
    public function __construct(Book $book)
    {
        parent::__construct($book);
        $this->book = $book;
    }

    /**
     * Retrieve a book with its author details by the book id.
     *
     * @param int
     * @return mixed
     */
    public function findWithAuthor($id)
    {
        // Retrieve the book by id with author data
        return $this->book->with('author')->find($id);
    }
}
