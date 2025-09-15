<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::truncate();

        Product::create([
            'name' => 'Sample Product 1',
            'code' => 'EPAYTEST1',
            'description' => 'This is the first sample product.',
            'price' => 100.0,
            'image' => 'product1.jpg', 
        ]);

        Product::create([
            'name' => 'Sample Product 2',
            'code' => 'EPAYTEST2',
            'description' => 'This is the second sample product.',
            'price' => 150.5,
            'image' => 'product2.jpg',
        ]);

        Product::create([
            'name' => 'Sample Product 3',
            'code' => 'EPAYTEST3',
            'description' => 'Third sample product with no image.',
            'price' => 200.0,
            'image' => null,
        ]);
    }
}
