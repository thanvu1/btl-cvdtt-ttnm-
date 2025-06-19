<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'order_id' => \App\Models\Order::inRandomOrder()->first()->id ?? 1,
        'product_id' => \App\Models\Product::inRandomOrder()->first()->id ?? 1,
        'quantity' => $this->faker->numberBetween(1, 5),
        'price' => $this->faker->numberBetween(100000, 500000),
    ];
    }
}
