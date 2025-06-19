<?php

namespace App\Patterns\Strategies\DiscountCode;

use App\Models\DiscountCode;

class FilterDiscountCodeStrategy implements \App\Patterns\Strategies\DiscountCode\DiscountCodeStrategyInterface
{
    public function handle($request, $model = null)
    {
        $query = DiscountCode::query();

        // Lọc theo ngày
        if ($request->filled('start_date')) {
            $query->where('started_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('expires_at', '<=', $request->end_date);
        }

        // Lọc theo trạng thái
        if ($request->filled('state')) {
            $query->whereIn('state', $request->state);
        }

        return $query;
    }
}
