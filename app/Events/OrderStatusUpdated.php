<?php

// app/Events/OrderStatusUpdated.php
namespace App\Events;

use App\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;

class OrderStatusUpdated
{
    use Dispatchable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}

