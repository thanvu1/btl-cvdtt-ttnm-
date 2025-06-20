<?php

namespace App\Patterns\Specifications;

use Illuminate\Database\Eloquent\Builder;

class StockGreaterThanSpecification implements Specification {
    public function __construct(private $amount) {}

    public function apply(Builder $query): Builder {
        return $query->where('stock', '>', $this->amount);
    }
}
