<?php
// app/Helpers/OrderHelper.php
namespace App\Helpers;

class OrderHelper
{
    public static function statusMessage($order)
    {
        return "Đơn hàng #{$order->id} đã cập nhật trạng thái: {$order->status}";
    }
}
