<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'product_name' => "Denim Jacket",
                'description' => 'Classic denim jacket, perfect for layering.',
                'excerpt' => 'Classic denim jacket',
                'img_filepath' => "placeholder",
                'price' => 59.99,
                'stock' => 60,
                'size' => 'M',
                'variant' => 'Unisex',
                'category' => 'Jackets',
            ],
            [
                'product_name' => "Striped Polo Shirt",
                'description' => 'Casual polo shirt with stylish stripes.',
                'excerpt' => 'Casual striped polo shirt',
                'img_filepath' => "placeholder",
                'price' => 29.99,
                'stock' => 80,
                'size' => 'L',
                'variant' => 'Male',
                'category' => 'T-shirts',
            ],
            [
                'product_name' => "Floral Maxi Dress",
                'description' => 'Elegant floral print maxi dress for special occasions.',
                'excerpt' => 'Elegant floral maxi dress',
                'img_filepath' => "placeholder",
                'price' => 69.99,
                'stock' => 40,
                'size' => 'M',
                'variant' => 'Female',
                'category' => 'Dresses',
            ],
            [
                'product_name' => "Khaki Chinos",
                'description' => 'Classic khaki chinos for a smart casual look.',
                'excerpt' => 'Classic khaki chinos',
                'img_filepath' => "placeholder",
                'price' => 44.99,
                'stock' => 70,
                'size' => 'XL',
                'variant' => 'Male',
                'category' => 'Pants',
            ],
            [
                'product_name' => "Striped Sweater",
                'description' => 'Cozy striped sweater for chilly days.',
                'excerpt' => 'Cozy striped sweater',
                'img_filepath' => "placeholder",
                'price' => 34.99,
                'stock' => 55,
                'size' => 'S',
                'variant' => 'Unisex',
                'category' => 'Sweaters',
            ],
            [
                'product_name' => "Denim Shorts",
                'description' => 'Stylish denim shorts for a casual summer look.',
                'excerpt' => 'Stylish denim shorts',
                'img_filepath' => "placeholder",
                'price' => 39.99,
                'stock' => 45,
                'size' => 'S',
                'variant' => 'Female',
                'category' => 'Shorts',
            ],
            [
                'product_name' => "V-neck Sweater",
                'description' => 'Classic V-neck sweater, perfect for layering.',
                'excerpt' => 'Classic V-neck sweater',
                'img_filepath' => "placeholder",
                'price' => 49.99,
                'stock' => 65,
                'size' => 'L',
                'variant' => 'Male',
                'category' => 'Sweaters',
            ],
            [
                'product_name' => "Bohemian Maxi Skirt",
                'description' => 'Bohemian-style maxi skirt with a relaxed fit.',
                'excerpt' => 'Bohemian maxi skirt',
                'img_filepath' => "placeholder",
                'price' => 54.99,
                'stock' => 35,
                'size' => 'M',
                'variant' => 'Female',
                'category' => 'Skirts',
            ],
            [
                'product_name' => "Leather Belt",
                'description' => 'Classic leather belt for a polished look.',
                'excerpt' => 'Classic leather belt',
                'img_filepath' => "placeholder",
                'price' => 29.99,
                'stock' => 90,
                'size' => 'M',
                'variant' => 'Unisex',
                'category' => 'Accessories',
            ],
            [
                'product_name' => "Printed T-shirt",
                'description' => 'Casual printed t-shirt with unique design.',
                'excerpt' => 'Casual printed t-shirt',
                'img_filepath' => "placeholder",
                'price' => 24.99,
                'stock' => 75,
                'size' => 'S',
                'variant' => 'Unisex',
                'category' => 'T-shirts',
            ],
        ];
        DB::table('products')->insert($products);
    }
}
