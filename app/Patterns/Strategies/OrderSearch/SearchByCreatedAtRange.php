<?php
namespace App\Patterns\Strategies\OrderSearch;

use Illuminate\Database\Eloquent\Builder;

class SearchByCreatedAtRange implements OrderSearchStrategy
{
    protected ?string $start;
    protected ?string $end;

    public function __construct(?string $start, ?string $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function apply(Builder $query): Builder
    {
        if ($this->start) {
            $query->whereDate('created_at', '>=', $this->start);
        }

        if ($this->end) {
            $query->whereDate('created_at', '<=', $this->end);
        }

        return $query;
    }
}
