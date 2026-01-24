<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $jersey = Category::where('slug', 'jersey')->first();
        $sepatu = Category::where('slug', 'sepatu')->first();
        $jaket  = Category::where('slug', 'jaket')->first();
        $accessories = Category::where('slug', 'accessories')->first();

        // 🔴 Jersey
        $p1 = Product::create([
            'name' => 'Manchester United Home Jersey 2024',
            'slug' => 'mu-home-jersey-2024',
            'category_id' => $jersey->id,
            'description' => 'Jersey kandang resmi Manchester United musim 2024.',
            'image' => 'images/products/mu-jersey.jpg',
]);

        ProductVariant::create([
            'product_id' => $p1->id,
            'price' => 1299000,
            'stock' => 50,
        ]);

        // 👟 Sepatu
        $p2 = Product::create([
            'name' => 'Adidas Predator Manchester United',
            'slug' => 'adidas-predator-mu',
            'category_id' => $sepatu->id,
            'description' => 'Sepatu bola Adidas Predator edisi Manchester United.',
            'image' => 'images/products/mu-shoes.jpg',
        ]);

        ProductVariant::create([
            'product_id' => $p2->id,
            'price' => 2499000,
            'stock' => 20,
        ]);

        // 🧥 Jaket
        $p3 = Product::create([
            'name' => 'MU Anthem Jacket',
            'slug' => 'mu-anthem-jacket',
            'category_id' => $jaket->id,
            'description' => 'Jaket anthem resmi Manchester United.',
            'image' => 'images/products/mu-jacket.jpg',
        ]);

        ProductVariant::create([
            'product_id' => $p3->id,
            'price' => 1799000,
            'stock' => 30,
        ]);

        // 🎽 Accessories
        $p4 = Product::create([
            'name' => 'Manchester United Accessories Pack',
            'slug' => 'manchester-united-accessories',
            'category_id' => $accessories->id ?? $jersey->id,
            'description' => 'Paket aksesori resmi Manchester United termasuk topi, scarf, dan merchandise eksklusif.',
            'image' => 'images/products/accessories.jpg',
        ]);

        ProductVariant::create([
            'product_id' => $p4->id,
            'price' => 499000,
            'stock' => 100,
        ]);
    }
}
