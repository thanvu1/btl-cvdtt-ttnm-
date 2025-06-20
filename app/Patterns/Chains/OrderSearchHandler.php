<?php

namespace App\Patterns\Chains;

use Illuminate\Database\Eloquent\Builder;
use App\Patterns\Strategies\OrderSearch\OrderSearchStrategy;

class OrderSearchHandler
{
    protected array $strategies = [];

    public function addStrategy(OrderSearchStrategy $strategy): self
    {
        $this->strategies[] = $strategy;
        return $this;
    }

    public function applyAll(Builder $query): Builder
    {
        foreach ($this->strategies as $strategy) {
            $query = $strategy->apply($query);
        }
        return $query;
    }
}

