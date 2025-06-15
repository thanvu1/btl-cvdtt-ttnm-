<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $thuocId = Category::where('name', 'Thuốc')->first()->id;

        Product::insert([
            [
                'category_id' => 1,
                'description' => 'Thuốc hạ sốt, giảm đau',
                'name' => 'Paracetamol 500mg',
                'price' => 15000,
                'stock' => 100
            ],
            [
                'category_id' => 1,
                'description' => 'Chống kết tập tiểu cầu',
                'name' => 'Aspirin 81mg',
                'price' => 20000,
                'stock' => 80
            ],
        ]);
    }
}
