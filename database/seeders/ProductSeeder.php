<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Neem Tree',
            'code' => 'NEEM001',
            'description' => 'Donate to plant a Neem tree. Great for shade and air purification.',
            'price' => 200,
            'image' => '/img/plants/neem.jpg',
        ]);

        Product::create([
            'name' => 'Bamboo Plant',
            'code' => 'BAMBOO001',
            'description' => 'Donate to plant a Bamboo plant. Helps reduce soil erosion.',
            'price' => 150,
            'image' => '/img/plants/bamboo.jpg',
        ]);

        Product::create([
            'name' => 'Rose Plant',
            'code' => 'ROSE001',
            'description' => 'Donate to plant a Rose plant. Adds beauty and fragrance.',
            'price' => 100,
            'image' => '/img/plants/rose.jpg',
        ]);

        Product::create([
            'name' => 'Mango Tree',
            'code' => 'MANGO001',
            'description' => 'Donate to plant a Mango tree. Provides fruits and shade.',
            'price' => 300,
            'image' => '/img/plants/mango.jpg',
        ]);
    }
}
