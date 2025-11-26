<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Rau củ', 'slug' => 'rau-cu', 'description' => 'Các loại rau củ tươi ngon', 'image' => 'uploads/categories/category-2.png'],
            ['name' => 'Trái cây', 'slug' => 'trai-cay', 'description' => 'Các loại trái cây tươi ngon', 'image' => 'uploads/categories/category-1.png'],
            ['name' => 'Thịt', 'slug' => 'thit', 'description' => 'Các loại thịt tươi ngon', 'image' => 'uploads/categories/category-4.png'],
            ['name' => 'Cá, hải sản', 'slug' => 'ca-hai-san', 'description' => 'Các loại cá, hải sản tươi ngon', 'image' => 'uploads/categories/category-5.png'],
            ['name' => 'Thực phẩm khác', 'slug' => 'thuc-pham-khac', 'description' => 'Các loại thực phẩm  giàu dinh dưỡng', 'image' => 'uploads/categories/category-3.png']
        ];

        foreach($categories as $category)
        {
            Category::create($category);
        }
    }
}
