<?php

namespace App\Repositories;

use App\Models\BaseModel;

interface RepositoryInterface
{
    public function create(array $attributes): BaseModel;

    public function read(int $id): ?BaseModel;

    public function update(int $id, array $attributes, string $types): bool;

    public function delete(int $id): bool;
}
