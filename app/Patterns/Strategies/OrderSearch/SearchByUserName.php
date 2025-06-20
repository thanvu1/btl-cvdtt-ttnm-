<?php

namespace App\Patterns\Strategies\OrderSearch;

use Illuminate\Database\Eloquent\Builder;

class SearchByUserName implements OrderSearchStrategy
{
    protected string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function apply(Builder $query): Builder
    {
        return $query->whereHas('user', function ($q) {
            $q->where('name', 'like', $this->username . '%');
            $q->whereRaw('LOWER(name) like ?', [strtolower($this->username) . '%']);

        });
    }
}
