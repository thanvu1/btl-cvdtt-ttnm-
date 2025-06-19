<?php

namespace Database\Factories;
use App\Models\Order;
use App\Models\User;
use App\Models\DiscountCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total_price' => $this->faker->numberBetween(100000, 500000),
            'status' => $this->faker->randomElement(['Đang xử lý', 'Đang giao', 'Giao thành công']),
            'phone' => '09' . fake()->numberBetween(10, 99) . fake()->numberBetween(100000, 999999),
            'shipping_address' => $this->faker->address(),
            'discount_code_id' => null, // hoặc null nếu không bắt buộc
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
