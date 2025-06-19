<?php

namespace App\Patterns\Strategies\DiscountCode;

class EditDiscountCodeStrategy implements DiscountCodeStrategyInterface
{
    public function handle($request, $model = null)
    {
        $data = $request->only([
            'code', 'discount_amount', 'type', 'min_order_value', 'state', 'started_at', 'expires_at', 'description'
        ]);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }
}
