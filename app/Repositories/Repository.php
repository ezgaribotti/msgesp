<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface
{
    public function __construct(
        protected Entity $entity
    )
    {}

    public function all(array $criteria = []): object
    {
        return $this->entity->where($criteria)->get();
    }

    public function create(array $data): object
    {
        $values = [];
        foreach ($data as $key => $value) {
            if (is_string($value))
                $value = trim($value);
            if (!empty($value)) $values[$key] = $value;
        }
        return $this->entity->create($values);
    }

    public function find($id, array $relations = []): object
    {
        return $this->entity->with($relations)->findOrFail($id);
    }

    public function findNotFail($id, array $relations = []): ?object
    {
        return $this->entity->with($relations)->find($id);
    }

    public function findByCriteria(array $criteria, array $relations = []): ?object
    {
        return $this->entity->where($criteria)->with($relations)->first();
    }

    public function update($id, array $data): void
    {
        $values = [];
        foreach ($data as $key => $value) {
            if (is_string($value))
                $value = trim($value);
            if (!empty($value)) $values[$key] = $value;
        }
        $this->entity->findOrFail($id)->update($values);
    }

    public function delete($id): void
    {
        $this->entity->findOrFail($id)->delete();
    }

    public function count(): int
    {
        return $this->entity->count();
    }
}
