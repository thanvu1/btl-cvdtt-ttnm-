<?php

namespace App\Patterns\Strategies\OrderSearch;

use Illuminate\Database\Eloquent\Builder;

interface OrderSearchStrategy {
    public function apply(Builder $query): Builder;
}