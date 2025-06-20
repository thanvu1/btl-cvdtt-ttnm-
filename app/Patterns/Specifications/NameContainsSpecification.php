<?php

namespace App\Patterns\Specifications;

use Illuminate\Database\Eloquent\Builder;

class NameContainsSpecification implements Specification
{
    protected string $keyword;

    public function __construct(string $keyword)
    {
        $this->keyword = $keyword;
    }

    public function apply(Builder $query): Builder
    {
        return $query->where('name', 'like', "%{$this->keyword}%");
    }
}
