<?php

namespace App\Patterns\Repository\Product;

use Illuminate\Support\Collection;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Product;
    public function create(array $data): Product;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;

    public function filterAndPaginate(array $filters, int $perPage = 15): LengthAwarePaginator;
}
