<?php

namespace App\Providers;
use App\Models\Order;
use App\Patterns\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $listen = [
        \App\Events\OrderStatusUpdated::class => [
            \App\Listeners\LogOrderStatusUpdate::class,
        ],
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Order::observe(OrderObserver::class);
    }
}
