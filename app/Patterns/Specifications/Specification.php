<?php

namespace App\Patterns\Specifications;

use Illuminate\Database\Eloquent\Builder;

interface Specification {
    public function apply(Builder $query): Builder;
}
