<?php

namespace App\Patterns\Strategies\DiscountCode;

class DiscountCodeContext
{
    protected $strategy;

    public function setStrategy(DiscountCodeStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute($request, $model = null)
    {
        return $this->strategy->handle($request, $model);
    }
}
