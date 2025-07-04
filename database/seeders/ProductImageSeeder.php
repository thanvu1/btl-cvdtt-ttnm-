<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product) {
            ProductImage::insert([
                [
                    'product_id' => $product->id,
                    'image_path' => 'demo1.jpg',
                    'is_main' => true
                ],
                [
                    'product_id' => $product->id,
                    'image_path' => 'demo2.jpg',
                    'is_main' => false
                ],
            ]);
        }
    }
}