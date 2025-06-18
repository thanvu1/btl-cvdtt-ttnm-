<?php
namespace App\Patterns\TemplateMethod\DiscountCode;

use Illuminate\Support\Carbon;

abstract class DiscountTemplate
{
    public function apply($orderTotal, $voucher, $cartItems = [])
    {
        if (!$this->isValid($voucher, $orderTotal, $cartItems)) {
            return 0;
        }
        return $this->calculateDiscount($orderTotal, $voucher, $cartItems);
    }

    protected function isValid($voucher, $orderTotal, $cartItems = [])
    {
        if ($voucher->state !== 'active') return false;

        $today = Carbon::today();

        if ($voucher->started_at && Carbon::parse($voucher->started_at)->gt($today)) return false;
        if ($voucher->expires_at && Carbon::parse($voucher->expires_at)->lt($today)) return false;

        if ($voucher->min_order_value && $orderTotal < $voucher->min_order_value) return false;

        return true;
    }

    abstract protected function calculateDiscount($orderTotal, $voucher, $cartItems = []);
}
