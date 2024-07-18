<?php

namespace App\Repositories\Author;

use App\Models\Author\Author;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\Author\AuthorContract;

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
        $perPage
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
    }
}
