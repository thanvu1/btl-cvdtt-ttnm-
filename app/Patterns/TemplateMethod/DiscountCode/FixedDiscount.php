<?php
namespace App\Patterns\TemplateMethod\DiscountCode;

class FixedDiscount extends DiscountTemplate
{
    protected function calculateDiscount($orderTotal, $voucher, $cartItems = [])
    {
        return min($voucher->discount_amount, $orderTotal);
    }
}
