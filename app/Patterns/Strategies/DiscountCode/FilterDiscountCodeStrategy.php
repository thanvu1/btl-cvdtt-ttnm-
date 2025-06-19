<?php

namespace App\Patterns\Strategies\DiscountCode;

use App\Models\DiscountCode;

class FilterDiscountCodeStrategy implements DiscountCodeStrategyInterface
{
    public function handle($request, $model = null)
    {
        $query = $model ?: DiscountCode::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->where(function ($q) use ($request) {
                $q->whereDate('started_at', '=', $request->start_date)
                    ->orWhereDate('expires_at', '=', $request->end_date);
            });
        } elseif ($request->filled('start_date')) {
            $query->whereDate('started_at', '=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('expires_at', '=', $request->end_date);
        }

        if ($request->filled('state')) {
            $query->whereIn('state', $request->state);
        }

        return $query;
    }
}

