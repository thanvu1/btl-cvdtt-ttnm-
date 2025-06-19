<?php

namespace App\Patterns\Strategies\DiscountCode;

use App\Models\DiscountCode;

class SearchDiscountCodeStrategy implements DiscountCodeStrategyInterface
{
    public function handle($request, $model = null)
    {
        // Sửa: dùng query truyền vào, nếu chưa có thì tạo mới
        $query = $model ?: DiscountCode::query();

        if ($request->filled('search')) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }
        return $query;
    }
}

