<?php

// app/Listeners/LogOrderStatusUpdate.php
namespace App\Listener;

use App\Events\OrderStatusUpdated;
use App\Helpers\OrderHelper;

class LogOrderStatusUpdate
{
    public function handle(OrderStatusUpdated $event)
    {
        // Gọi helper để tạo message đồng bộ với controller
        $message = OrderHelper::statusMessage($event->order);
        Log::info($message);
    }
}
