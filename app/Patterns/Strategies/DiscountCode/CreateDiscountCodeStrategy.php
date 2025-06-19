<?php

namespace App\Patterns\Strategies\DiscountCode;

use App\Models\DiscountCode;

class CreateDiscountCodeStrategy implements \App\Patterns\Strategies\DiscountCode\DiscountCodeStrategyInterface
{
    public function handle($request, $model = null)
    {
        $data = $request->only([
            'code', 'discount_amount', 'type', 'min_order_value', 'state', 'started_at', 'expires_at', 'description'
        ]);
        return DiscountCode::create($data);
    }
}
