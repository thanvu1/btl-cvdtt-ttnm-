<?php
namespace App\Patterns\TemplateMethod\DiscountCode;

use App\Patterns\TemplateMethod\DiscountCode\FixedDiscount;
use App\Patterns\TemplateMethod\DiscountCode\PercentDiscount;

class DiscountTemplateFactory
{
    public static function make($voucher)
    {
        switch ($voucher->type) {
            case 'percent':
                return new PercentDiscount();
            case 'fixed':
            default:
                return new FixedDiscount();
        }
    }
}
