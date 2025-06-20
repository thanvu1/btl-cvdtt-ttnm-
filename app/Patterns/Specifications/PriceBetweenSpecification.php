<?php

namespace App\Patterns\Specifications;

use Illuminate\Database\Eloquent\Builder;

class PriceBetweenSpecification implements Specification {
    // public function __construct(private $min, private $max) {}

    // public function apply(Builder $query): Builder {
    //     return $query->whereBetween('price', [$this->min, $this->max]);
    // }
    public function __construct(private $min, private $max) {
        $this->min = $min;
        $this->max = $max;
    }

    public function apply(Builder $query): Builder {
        return $query->whereBetween('price', [$this->min, $this->max]);
    }
}

