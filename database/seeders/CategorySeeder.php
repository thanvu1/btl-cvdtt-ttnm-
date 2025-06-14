<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Thuốc', 'description' => 'Các loại thuốc chữa bệnh'],
            ['name' => 'Thiết bị y tế', 'description' => 'Máy đo huyết áp, nhiệt kế,...'],
            ['name' => 'Thực phẩm chức năng', 'description' => 'Bổ sung dinh dưỡng, vitamin'],
        ]);
    }
}
