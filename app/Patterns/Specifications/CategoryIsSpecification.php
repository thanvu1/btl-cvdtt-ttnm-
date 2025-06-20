<?php

namespace App\Patterns\Specifications;

use Illuminate\Database\Eloquent\Builder;

class CategoryIsSpecification implements Specification {
    public function __construct(private $categoryId) {}

    public function apply(Builder $query): Builder {
        return $query->where('category_id', $this->categoryId);
    }
}
