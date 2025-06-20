<?php

namespace App\Patterns\Specifications;

use Illuminate\Database\Eloquent\Builder;

class AndSpecification implements Specification {
    public function __construct(private array $specs) {}

    public function apply(Builder $query): Builder {
        foreach ($this->specs as $spec) {
            $query = $spec->apply($query);
        }
        return $query;
    }
}
