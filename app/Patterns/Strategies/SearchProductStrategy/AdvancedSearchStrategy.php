<?php

namespace App\Patterns\Strategies\SearchProductStrategy;

use App\Models\Product;
use App\Patterns\Specifications\AndSpecification;
use App\Patterns\Specifications\CategoryIsSpecification;
use App\Patterns\Specifications\PriceBetweenSpecification;
use App\Patterns\Specifications\StockGreaterThanSpecification;
use App\Patterns\Specifications\NameContainsSpecification;
class AdvancedSearchStrategy implements SearchProductStrategy {
    public function search(string $keyword): \Illuminate\Database\Eloquent\Builder {
    $query = Product::query();
    $specs = [];

    if (!empty($keyword)) {
        $specs[] = new NameContainsSpecification($keyword);
    }

    // if (request('price') && str_contains(request('price'), '-')) {
    //     [$min, $max] = explode('-', request('price'));
    //     $specs[] = new PriceBetweenSpecification($min, $max);
    // }
    if (request('price') && preg_match('/^\s*(\d+)\s*-\s*(\d+)\s*$/', request('price'), $matches)) {
    $min = (int) $matches[1];
    $max = (int) $matches[2];
    $specs[] = new PriceBetweenSpecification($min, $max);
}



    if (request('category')) {
        $specs[] = new CategoryIsSpecification(request('category'));
    }

    if (request('in_stock')) {
        $specs[] = new StockGreaterThanSpecification(0);
    }

    $finalSpec = new AndSpecification($specs);
    return $finalSpec->apply($query);
    }
}
