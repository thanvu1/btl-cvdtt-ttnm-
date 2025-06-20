<?php

namespace App\Patterns\Repository\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class EloquentProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::all();
    }

    public function find(int $id): ?Product
    {
        return Product::find($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $product = Product::find($id);
        return $product ? $product->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $product = Product::find($id);
        return $product ? $product->delete() : false;
    }

    public function filterAndPaginate(array $filters, int $perPage = 15):LengthAwarePaginator
    {
        $query = Product::query();

    if (!empty($filters['category_id'])) {
        $query->where('category_id', $filters['category_id']);
    }

    if (!empty($filters['country'])) {
        $query->where('country', $filters['country']);
    }

    if (!empty($filters['search'])) {
        $query->where('name', 'like', '%' . $filters['search'] . '%');
    }

    $query->orderBy('created_at', 'desc');

    return $query->with('category')->paginate($perPage)->appends($filters);
    }

}
