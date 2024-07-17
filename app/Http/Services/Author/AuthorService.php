<?php

namespace App\Http\Services\Author;

use App\Repositories\Contracts\Author\AuthorContract;

class AuthorService
{
    protected $repository;

    public function __construct(AuthorContract $repository)
    {
        $this->repository = $repository;
    }

    public function storeService(array $request)
    {
        return $this->repository->store($request);
    }

    public function findService($id)
    {
        return $this->repository->find($id);
    }

    public function updateService(array $attributes, $id)
    {
        return $this->repository->update($attributes, $id);
    }
}
