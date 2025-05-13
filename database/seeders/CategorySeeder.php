<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics'       => ['Mobile Phones', 'Laptops', 'Cameras'],
            'Fashion'           => ['Men', 'Women', 'Kids'],
            'Home & Kitchen'    => ['Furniture', 'Decor', 'Appliances'],
            'Sports & Outdoors' => ['Fitness', 'Camping', 'Cycling']
        ];

        foreach ($categories as $categoryName => $subCategories) {
            $category = Category::create([
                'name'   => $categoryName,
                'status' => 'active'
            ]);

            foreach ($subCategories as $subCategoryName) {
                SubCategory::create([
                    'category_id' => $category->id,
                    'name'        => $subCategoryName,
                    'status'      => 'active'
                ]);
            }
        }
    }
}
