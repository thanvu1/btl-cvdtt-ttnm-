<?php

namespace App\Patterns\Strategies\DiscountCode;

use App\Models\DiscountCode;

class SearchDiscountCodeStrategy implements \App\Patterns\Strategies\DiscountCode\DiscountCodeStrategyInterface
{
    public function handle($request, $model = null)
    {
        $query = DiscountCode::query();
        if ($request->filled('search')) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }
        return $query;
    }
}
