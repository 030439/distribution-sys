<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Pro X1',
                'description' => 'High-performance laptop with 16GB RAM and 512GB SSD',
                'price' => 1299.99,
                'stock_quantity' => 25,
                'sku' => 'LP-X1-001',
                'active' => true,
                'image_url' => 'https://via.placeholder.com/300x200?text=Laptop+Pro+X1',
            ],
            [
                'name' => 'Smartphone Galaxy S22',
                'description' => 'Latest smartphone with 6.1-inch display and 128GB storage',
                'price' => 899.99,
                'stock_quantity' => 50,
                'sku' => 'SG-S22-002',
                'active' => true,
                'image_url' => 'https://via.placeholder.com/300x200?text=Galaxy+S22',
            ],
            [
                'name' => 'Wireless Noise-Canceling Headphones',
                'description' => 'Premium headphones with 20-hour battery life',
                'price' => 249.99,
                'stock_quantity' => 35,
                'sku' => 'WH-NC-003',
                'active' => true,
                'image_url' => 'https://via.placeholder.com/300x200?text=Headphones',
            ],
            [
                'name' => 'Smart Watch Series 7',
                'description' => 'Fitness tracking, heart rate monitoring, and notifications',
                'price' => 349.99,
                'stock_quantity' => 30,
                'sku' => 'SW-S7-004',
                'active' => true,
                'image_url' => 'https://via.placeholder.com/300x200?text=Smart+Watch',
            ],
            [
                'name' => 'Tablet Air 5',
                'description' => '10.9-inch display, 64GB storage, Wi-Fi',
                'price' => 499.99,
                'stock_quantity' => 20,
                'sku' => 'TA-5-005',
                'active' => true,
                'image_url' => 'https://via.placeholder.com/300x200?text=Tablet+Air',
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
