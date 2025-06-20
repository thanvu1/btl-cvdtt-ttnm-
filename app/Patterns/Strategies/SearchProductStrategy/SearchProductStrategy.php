<?php

namespace App\Patterns\Strategies\SearchProductStrategy;

interface SearchProductStrategy {
    public function search(string $keyword): \Illuminate\Database\Eloquent\Builder;
}
