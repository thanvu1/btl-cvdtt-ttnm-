<?php

namespace App\Patterns\Strategies\OrderSearch;

use Illuminate\Database\Eloquent\Builder;

class SearchByPhone implements OrderSearchStrategy
{
    protected string $phone;

    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    public function apply(Builder $query): Builder
    {
        return $query->where('phone', 'like', "%{$this->phone}%");
    }
}
