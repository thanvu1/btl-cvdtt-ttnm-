<?php

namespace App\Patterns\Strategies\SearchProductStrategy;

use App\Models\Product;

class BasicSearchStrategy implements SearchProductStrategy {
    public function search(string $keyword): \Illuminate\Database\Eloquent\Builder {
        return Product::query()->where(function($q) use ($keyword) {
            $q->where('name', 'like', $keyword . '%'); //tìm theo t
        });
    }
}
