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
        $categories = Category::pluck('id', 'name');

        Product::insert([
            // Thuốc
            [
                'category_id' => $categories['Thuốc'],
                'description' => 'Thuốc hạ sốt, giảm đau',
                'name' => 'Paracetamol 500mg',
                'price' => 15000,
                'country' => 'Việt Nam',
                'stock' => 100,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thuốc'],
                'description' => 'Chống kết tập tiểu cầu',
                'name' => 'Aspirin 81mg',
                'price' => 20000,
                'country' => 'Việt Nam',
                'stock' => 80,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thuốc'],
                'description' => 'Kháng sinh phổ rộng',
                'name' => 'Amoxicillin 500mg',
                'price' => 25000,
                'country' => 'Việt Nam',
                'stock' => 60,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thuốc'],
                'description' => 'Kháng sinh điều trị nhiễm khuẩn',
                'name' => 'Cefixime 200mg',
                'price' => 35000,
                'country' => 'Việt Nam',
                'stock' => 50,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thuốc'],
                'description' => 'Giảm đau, hạ sốt, chống viêm',
                'name' => 'Ibuprofen 400mg',
                'price' => 18000,
                'country' => 'Việt Nam',
                'stock' => 70,
                'expiration_date' => '2026-12-31'
            ],

            // Thiết bị y tế
            [
                'category_id' => $categories['Thiết bị y tế'],
                'description' => 'Máy đo huyết áp điện tử',
                'name' => 'Máy đo huyết áp Omron',
                'price' => 650000,
                'country' => 'Việt Nam',
                'stock' => 20,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thiết bị y tế'],
                'description' => 'Nhiệt kế điện tử đo trán',
                'name' => 'Nhiệt kế Microlife',
                'price' => 250000,
                'country' => 'Việt Nam',
                'stock' => 30,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thiết bị y tế'],
                'description' => 'Máy xông mũi họng cho trẻ em',
                'name' => 'Máy xông Omron NE-C28',
                'price' => 900000,
                'country' => 'Việt Nam',
                'stock' => 10,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thiết bị y tế'],
                'description' => 'Bộ test nhanh Covid-19',
                'name' => 'Test nhanh Humasis',
                'price' => 70000,
                'country' => 'Việt Nam',
                'stock' => 100,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thiết bị y tế'],
                'description' => 'Máy đo đường huyết cá nhân',
                'name' => 'Máy đo đường huyết Accu-Chek',
                'price' => 550000,
                'country' => 'Việt Nam',
                'stock' => 15,
                'expiration_date' => '2026-12-31'
            ],

            // Thực phẩm chức năng
            [
                'category_id' => $categories['Thực phẩm chức năng'],
                'description' => 'Bổ sung vitamin C tăng sức đề kháng',
                'name' => 'Vitamin C 500mg',
                'price' => 30000,
                'country' => 'Việt Nam',
                'stock' => 90,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thực phẩm chức năng'],
                'description' => 'Bổ sung Omega 3 cho tim mạch',
                'name' => 'Omega 3 Fish Oil',
                'price' => 120000,
                'country' => 'Việt Nam',
                'stock' => 40,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thực phẩm chức năng'],
                'description' => 'Bổ sung canxi cho xương chắc khỏe',
                'name' => 'Canxi D3',
                'price' => 95000,
                'country' => 'Việt Nam',
                'stock' => 50,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thực phẩm chức năng'],
                'description' => 'Hỗ trợ làm đẹp da, tóc, móng',
                'name' => 'Collagen Plus',
                'price' => 150000,
                'country' => 'Việt Nam',
                'stock' => 35,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Thực phẩm chức năng'],
                'description' => 'Bổ sung sắt cho phụ nữ mang thai',
                'name' => 'Sắt hữu cơ Ferrovit',
                'price' => 80000,
                'country' => 'Việt Nam',
                'stock' => 60,
                'expiration_date' => '2026-12-31'
            ],

            // Chăm sóc cá nhân
            [
                'category_id' => $categories['Chăm sóc cá nhân'],
                'description' => 'Sữa tắm dưỡng ẩm cho da',
                'name' => 'Sữa tắm Dove',
                'price' => 65000,
                'country' => 'Việt Nam',
                'stock' => 40,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Chăm sóc cá nhân'],
                'description' => 'Dầu gội sạch gàu',
                'name' => 'Dầu gội Head & Shoulders',
                'price' => 75000,
                'country' => 'Việt Nam',
                'stock' => 50,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Chăm sóc cá nhân'],
                'description' => 'Kem đánh răng ngừa sâu răng',
                'name' => 'Kem đánh răng Sensodyne',
                'price' => 45000,
                'country' => 'Việt Nam',
                'stock' => 60,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Chăm sóc cá nhân'],
                'description' => 'Lăn khử mùi nam',
                'name' => 'Lăn khử mùi Nivea Men',
                'price' => 55000,
                'country' => 'Việt Nam',
                'stock' => 30,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Chăm sóc cá nhân'],
                'description' => 'Khăn giấy ướt tiện lợi',
                'name' => 'Khăn giấy ướt Bobby',
                'price' => 25000,
                'country' => 'Việt Nam',
                'stock' => 100,
                'expiration_date' => '2026-12-31'
            ],

            // Dược-mỹ phẩm
            [
                'category_id' => $categories['Dược-mỹ phẩm'],
                'description' => 'Kem chống nắng bảo vệ da',
                'name' => 'Kem chống nắng Anessa',
                'price' => 350000,
                'country' => 'Việt Nam',
                'stock' => 25,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Dược-mỹ phẩm'],
                'description' => 'Sữa rửa mặt dịu nhẹ',
                'name' => 'Sữa rửa mặt Cetaphil',
                'price' => 120000,
                'country' => 'Việt Nam',
                'stock' => 40,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Dược-mỹ phẩm'],
                'description' => 'Kem dưỡng ẩm cho da khô',
                'name' => 'Kem dưỡng ẩm Vaseline',
                'price' => 90000,
                'country' => 'Việt Nam',
                'stock' => 35,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Dược-mỹ phẩm'],
                'description' => 'Nước tẩy trang làm sạch sâu',
                'name' => 'Nước tẩy trang Bioderma',
                'price' => 220000,
                'country' => 'Việt Nam',
                'stock' => 30,
                'expiration_date' => '2026-12-31'
            ],
            [
                'category_id' => $categories['Dược-mỹ phẩm'],
                'description' => 'Son dưỡng môi không màu',
                'name' => 'Son dưỡng Vaseline',
                'price' => 60000,
                'country' => 'Việt Nam',
                'stock' => 50,
                'expiration_date' => '2026-12-31'
            ],
        ]);
    }
}
