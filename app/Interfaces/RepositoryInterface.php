<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function all(array $criteria = []): object;

    public function create(array $data): object;

    public function find($id, array $relations = []): object;

    public function findNotFail($id, array $relations = []): ?object;

    public function findByCriteria(array $criteria, array $relations = []): ?object;

    public function update($id, array $data): void;

    public function delete($id): void;

    public function count(): int;
}
