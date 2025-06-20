<?php

// app/Patterns/Observers/OrderObserver.php

namespace App\Patterns\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    public function updated(Order $order)
    {
        // In ra message trực tiếp, không cần helper
        $message = "Đơn hàng #{$order->id} đã cập nhật trạng thái: {$order->status}";
        Log::info($message);

        // Nếu muốn truyền sang frontend, có thể ghi vào session ở đây nếu cần
        session()->flash('order_status_message', $message);
    }
}

