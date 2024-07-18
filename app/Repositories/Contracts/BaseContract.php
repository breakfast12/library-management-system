<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseContract
{
    // Register the repository method

    public function all(): Collection;

    public function find($id): ?Model;

    public function store(array $attributes): ?Model;

    public function update(array $attributes, $id);

    public function delete($id);
}
