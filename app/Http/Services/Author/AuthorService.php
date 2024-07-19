<?php

namespace App\Http\Services\Author;

use App\Repositories\Contracts\Author\AuthorContract;

class AuthorService
{
    /**
     * The author repository instance.
     *
     * @var AuthorContract
     */
    protected $repository;

    /**
     * Constructor to initialize the repository.
     *
     * @param AuthorContract
     */
    public function __construct(AuthorContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of authors based on filters and pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function indexService()
    {
        // Get search and filter parameters from the request.
        $search = request('search');
        $birthDateFrom = request('birth_date_from');
        $birthDateTo = request('birth_date_to');
        $orderBy = request('order_by', 'created_at');
        $order = request('order', 'desc');
        $perPage = request('per_page', 10);

        // Retrieve authors from the repository with filters.
        return $this->repository->getAuthors(
            $search,
            $birthDateFrom,
            $birthDateTo,
            $orderBy,
            $order,
            $perPage,
        );
    }

    /**
     * Store a new author.
     *
     * @param array
     * @return mixed
     */
    public function storeService(array $request)
    {
        // Use the repository to store the author.
        return $this->repository->store($request);
    }

    /**
     * Find author by id.
     *
     * @param int
     * @return mixed
     */
    public function findService($id)
    {
        // Use the repository to find the author.
        return $this->repository->find($id);
    }

    /**
     * Update existing author.
     *
     * @param array
     * @param int
     * @return int
     */
    public function updateService(array $attributes, $id)
    {
        // Use the repository to update the author.
        return $this->repository->update($attributes, $id);
    }

    /**
     * Delete author by ID.
     *
     * @param int
     * @return int
     */
    public function deleteService($id)
    {
        // Use the repository to delete the author.
        return $this->repository->delete($id);
    }

    /**
     * Get list of books based on author, filters, and pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCatalogue($id)
    {
        // Get search and filter parameters from the request.
        $sort = request('sort', 'desc');
        $perPage = request('per_page', 10);

        // Retrieve author catalogue from the repository with filters.
        return $this->repository->findWithBook(
            $id,
            $perPage,
            $sort,
        );
    }
}
