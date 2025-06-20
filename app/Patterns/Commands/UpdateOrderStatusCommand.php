<?php

namespace App\Patterns\Commands;

use App\Models\Order;

class UpdateOrderStatusCommand
{
    protected $order;
    protected $newStatus;

    public function __construct(Order $order, string $newStatus)
    {
        $this->order = $order;
        $this->newStatus = $newStatus;
    }

    public function execute()
    {
        $this->order->status = $this->newStatus;
        $this->order->save();
    }
}
