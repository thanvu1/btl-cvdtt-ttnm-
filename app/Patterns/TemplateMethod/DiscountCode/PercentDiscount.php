<?php
namespace App\Patterns\TemplateMethod\DiscountCode;

class PercentDiscount extends DiscountTemplate
{
    protected function calculateDiscount($orderTotal, $voucher, $cartItems = [])
    {
        $percent = floatval($voucher->discount_amount);
        $discount = round($orderTotal * ($percent / 100));
        return min($discount, $orderTotal);
    }
}
