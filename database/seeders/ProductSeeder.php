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
                'name' => 'Paracetamol 500mg',
                'category_id' => $thuocId,
                'description' => 'Thuốc hạ sốt, giảm đau',
                'price' => 15000,
                'stock' => 100,
                'image' => null, // có thể bỏ nếu dùng bảng product_images
            ],
            [
                'name' => 'Aspirin 81mg',
                'category_id' => $thuocId,
                'description' => 'Chống kết tập tiểu cầu',
                'price' => 20000,
                'stock' => 80,
                'image' => null,
            ],
        ]);
    }
}
