<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\DiscountCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        DiscountCode::factory()->count(10)->create();
        Order::factory()->count(20)->create(); // Tạo 20 đơn hàng
    }
}
