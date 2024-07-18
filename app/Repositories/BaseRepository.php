<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements BaseContract
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records from the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find a record by its id.
     *
     * @param int
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Store a new record in the model.
     *
     * @param array
     */
    public function store(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Update a record in the model by its id.
     *
     * @param array
     * @param int
     * @return int
     */
    public function update(array $attributes, $id)
    {
        return $this->model
            ->where('id', $id)
            ->update($attributes);
    }

    /**
     * Delete a record from the model by its ID.
     *
     * @param int
     * @return int
     */
    public function delete($id)
    {
        return $this->model
            ->where('id', $id)
            ->delete();
    }
}
