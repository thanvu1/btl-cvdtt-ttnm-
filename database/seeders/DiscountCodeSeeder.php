<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiscountCodeSeeder extends Seeder
{
    public function run(): void
    {
        $today = Carbon::today();
        $expires = $today->copy()->addDays(30);

        $discounts = [];

        for ($i = 1; $i <= 10; $i++) {
            $code = 'KM' . str_pad($i, 4, '0', STR_PAD_LEFT); // KM0001, KM0002, ..., KM0010
            $discountPercent = rand(8, 15); // số nguyên từ 8 đến 15
            $minOrderValue = rand(100000, 500000);

            $discounts[] = [
                'code' => $code,
                'discount_amount' => $discountPercent,
                'type' => 'percent',
                'min_order_value' => $minOrderValue,
                'state' => 'active',
                'started_at' => $today,
                'expires_at' => $expires,
                'description' => "{$discountPercent}% giảm cho đơn hàng từ {$minOrderValue} trở lên",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('discount_codes')->insert($discounts);
    }
}
