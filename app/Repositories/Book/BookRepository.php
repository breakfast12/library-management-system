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
     * List of columns that can be used for sorting.
     *
     * @var array
     */
    protected $allowedColumns = [
        'title',
        'description',
        'publish_date',
        'author_name',
        'created_at',
        'updated_at',
    ];

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

    /**
     * Retrieves paginated list of books based on search criteria or filter.
     *
     * @param string|null
     * @param string|null
     * @param string|null
     * @param string
     * @param string
     * @param int
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getBooks(
        $search,
        $publishDateFrom,
        $publishDateTo,
        $orderBy,
        $order,
        $perPage
    ) {
        // Main query
        $query = $this->book->with('author');

        // Filter by search term if provided.
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhereHas('author', function ($q) use ($search) {
                        $q->where('name', 'like', '%'.$search.'%');
                    });
            });
        }

        // Filter by publish date range if start and end dates are provided.
        if ($publishDateFrom && $publishDateTo) {
            $query->whereBetween('publish_date', [$publishDateFrom, $publishDateTo]);
        } elseif ($publishDateFrom) {
            // Filter by start date if only start date is provided.
            $query->where('publish_date', '>=', $publishDateFrom);
        } elseif ($publishDateTo) {
            // Filter by end date if only end date is provided.
            $query->where('publish_date', '<=', $publishDateTo);
        }

        // Sorting.
        if ($orderBy == 'author_name') {
            // Join with authors for sorting by author name.
            $query->join('authors', 'books.author_id', '=', 'authors.id')
                ->orderBy('authors.name', $order)
                ->select('books.*');
        } else {
            // Default sorting handling.
            if (! in_array($orderBy, $this->allowedColumns)) {
                $orderBy = 'created_at';
            }

            $query->orderBy($orderBy, $order);
        }

        // Return paginated results.
        return $query->paginate($perPage);
    }
}
