<?php

namespace App\Repositories\Author;

use App\Models\Author\Author;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\Author\AuthorContract;
use Illuminate\Support\Facades\Cache;

class AuthorRepository extends BaseRepository implements AuthorContract
{
    /**
     * The author model instance.
     *
     * @var Author
     */
    protected $author;

    /**
     * List of columns that can be used for sorting.
     *
     * @var array
     */
    protected $allowedColumns = [
        'name',
        'bio',
        'birth_date',
        'created_at',
        'updated_at',
    ];

    /**
     * Constructor for AuthorRepository and call parent constructor.
     *
     * @param Author
     */
    public function __construct(Author $author)
    {
        parent::__construct($author);
        $this->author = $author;
    }

    /**
     * Retrieves paginated list of authors based on search criteria or filter.
     *
     * @param string|null
     * @param string|null
     * @param string|null
     * @param string
     * @param string
     * @param int
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAuthors(
        $search,
        $birthDateFrom,
        $birthDateTo,
        $orderBy,
        $order,
        $perPage,
        $page,
    ) {
        // Generate a cache key based on the given parameters
        $cacheKey = "authors_index_{$search}_{$birthDateFrom}_{$birthDateTo}_{$orderBy}_{$order}_{$perPage}_page_{$page}";

        // Retrieve cached results or execute the query if not cached
        return Cache::tags(['authors'])->remember($cacheKey, 3600, function () use (
            $search,
            $birthDateFrom,
            $birthDateTo,
            $orderBy,
            $order,
            $perPage,
        ) {
            // Main query
            $query = $this->author->query();

            // Filter by search term if provided.
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('bio', 'like', '%'.$search.'%');
                });
            }

            // Filter by birth date range if start and end dates are provided.
            if ($birthDateFrom && $birthDateTo) {
                $query->whereBetween('birth_date', [$birthDateFrom, $birthDateTo]);
            } elseif ($birthDateFrom) {
                // Filter by start date if only start date is provided.
                $query->where('birth_date', '>=', $birthDateFrom);
            } elseif ($birthDateTo) {
                // Filter by end date if only end date is provided.
                $query->where('birth_date', '<=', $birthDateTo);
            }

            // Sort by creation date if column is not provided.
            if (! in_array($orderBy, $this->allowedColumns)) {
                $orderBy = 'created_at';
            }

            // Return ordered, paginated results.
            return $query->orderBy($orderBy, $order)->paginate($perPage);
        });
    }

    /**
     * Retrieve author with their books by the author id.
     *
     * @param int
     * @param int
     * @param string
     * @return object
     */
    public function findWithBook($id, $perPage, $sortOrder, $page)
    {
        // Generate a cache key based on the given parameters
        $cacheKey = "authors_{$id}_books_{$perPage}_{$sortOrder}_page_{$page}";

        // Retrieve cached results or execute the query if not cached
        return Cache::tags(["author_{$id}", "books_author_{$id}"])->remember($cacheKey, 3600, function () use (
            $id,
            $perPage,
            $sortOrder
        ) {
            // Find the author by id
            $author = $this->author->find($id);

            // Retrieve and paginate the author books, sorted by publish date
            $books = $author->books()->orderBy('publish_date', $sortOrder)->paginate($perPage);

            // Return object with the author and their books
            return (object) [
                'author' => $author,
                'books' => $books,
            ];
        });
    }
}
