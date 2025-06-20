<?php

namespace App\Patterns\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    public function updated(Order $order)
    {
        Log::info("Đơn hàng #{$order->id} đã cập nhật trạng thái: {$order->status}");

        // Bạn có thể thêm gửi email / notification ở đây
        // Ví dụ:
        // Notification::route('mail', $order->user->email)
        //     ->notify(new OrderStatusUpdatedNotification($order));
    }
}
