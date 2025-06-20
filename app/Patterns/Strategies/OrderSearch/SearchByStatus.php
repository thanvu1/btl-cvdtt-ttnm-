<?php

namespace App\Patterns\Strategies\OrderSearch;

use Illuminate\Database\Eloquent\Builder;

class SearchByStatus implements OrderSearchStrategy {
    protected string $status;

    public function __construct(string $status) {
        $this->status = $status;
    }

    public function apply(Builder $query): Builder {
        return $query->where('status', $this->status);
    }
}
