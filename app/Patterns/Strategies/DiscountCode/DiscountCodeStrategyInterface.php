<?php

namespace App\Patterns\Strategies\DiscountCode;

interface DiscountCodeStrategyInterface
{
    public function handle($request, $model = null);
}
