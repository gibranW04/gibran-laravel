<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Jersey',
                'slug' => 'jersey',
            ],
            [
                'name' => 'Sepatu',
                'slug' => 'sepatu',
            ],
            [
                'name' => 'Jaket',
                'slug' => 'jaket',
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
            ],
        ]);
    }
}
