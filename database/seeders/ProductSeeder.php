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
                'img_filepath' => "https://rle.yr-wr.com/denim/prod/preview/?w=1200&h=1200&vo=6&vr=710833735001&de=1&di=149&do=0&locale=en_NL&t2t=RALPH&t2c=C1730&t2f=1",
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
                'img_filepath' => "https://thrifttale.com/cdn/shop/files/Ralph-Lauren-Striped-Polo-Shirt-by-Ralph-Lauren-68140499.jpg?v=1698503489&width=2048",
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
                'img_filepath' => "https://www.circlecloset.nl/cdn/shop/products/dress_flowers_white_colors_essentiel_antwerp_front_3f23191c-a0f2-4b85-aed6-43d356c67c36_800x.jpg?v=1677154190",
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
                'img_filepath' => "https://www.careofcarl.nl/bilder/artiklar/zoom/25277711r_1.jpg?m=1686311194",
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
                'img_filepath' => "https://static.sartofashion.nl/images/productimages/113161-V019/113161-V019-2-1500x1500.jpg",
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
                'img_filepath' => "https://cdn-images.farfetch-contents.com/14/16/01/84/14160184_18904041_1000.jpg",
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
                'img_filepath' => "https://media.s-bol.com/6984V0jZ70yL/550x767.jpg",
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
                'img_filepath' => "https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcQEjiq7ueWC-loHtFltLEIND1FDpoKITyRLrPW5VvzfCXiZ-oP3v_6UXOS5sOYz0uC-aWHBJ4BXf8ZdsJcSWWCH31aOY4ga9qLE4iPaoo1ikgkM7SJp1AsD&usqp=CAc",
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
                'img_filepath' => "https://www.dstrezzed.com/cdn/shop/files/651240_790_50.jpg?v=1694078243",
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
                'img_filepath' => "https://image.spreadshirtmedia.net/image-server/v1/mp/productTypes/6/views/1/appearances/1,width=550,height=550,backgroundColor=e5e5e5/mannen-t-shirt-voor.jpg",
                'price' => 24.99,
                'stock' => 75,
                'size' => 'S',
                'variant' => 'Unisex',
                'category' => 'T-shirts',
            ],
            [
                'product_name' => "Black and White sneakers",
                'description' => 'Casual Black and White sneakers ready for any trip.',
                'excerpt' => 'Casual Black and White sneakers',
                'img_filepath' => "https://i.ebayimg.com/images/g/DMEAAOSwWcZiOi-5/s-l1200.jpg",
                'price' => 50.00,
                'stock' => 23,
                'size' => 'L',
                'variant' => 'Male',
                'category' => 'Shoes',
            ],
            [
                'product_name' => "Hooded Sweatshirt",
                'description' => 'Comfortable and warm hooded sweatshirt for casual wear.',
                'excerpt' => 'Comfortable hooded sweatshirt',
                'img_filepath' => "https://img01.ztat.net/article/spp-media-p1/b41f67d9feef44ba888c213f8d646b01/3546752ef7d6415e82772fdfea9d92ea.jpg?imwidth=1800&filter=packshot",
                'price' => 39.99,
                'stock' => 50,
                'size' => 'M',
                'variant' => 'Unisex',
                'category' => 'Sweatshirts',
            ],
            [
                'product_name' => "Slim Fit Jeans",
                'description' => 'Slim fit jeans for a modern and stylish look.',
                'excerpt' => 'Slim fit jeans',
                'img_filepath' => "https://images.onlyandsons.com/22024326/4047462/001/onlysons-slimfitregularrisejeans-blue.jpg?v=866074158ad0c7a2115e93573374aa21&format=webp&width=1280&quality=90&key=25-0-3",
                'price' => 49.99,
                'stock' => 60,
                'size' => 'L',
                'variant' => 'Male',
                'category' => 'Pants',
            ],
            [
                'product_name' => "Knit Sweater",
                'description' => 'Soft and cozy knit sweater perfect for chilly days.',
                'excerpt' => 'Soft knit sweater',
                'img_filepath' => "https://images.only.com/15313540/4455422/001/only-regularfitroundneckribbedcuffsknitcardigan-white.jpg?v=99c75af3dc5f357405e76f155f2b358c&format=webp&width=1280&quality=90&key=25-0-3",
                'price' => 45.99,
                'stock' => 70,
                'size' => 'S',
                'variant' => 'Female',
                'category' => 'Sweaters',
            ],
            [
                'product_name' => "Leather Jacket",
                'description' => 'Classic leather jacket for a timeless style statement.',
                'excerpt' => 'Classic leather jacket',
                'img_filepath' => "https://images.only.com/15233179/3650138/001/only-jacket-black.jpg?v=a09874d32d80a5c7ffb92ae56d88e2e1&format=webp&width=1280&quality=90&key=25-0-3",
                'price' => 99.99,
                'stock' => 40,
                'size' => 'M',
                'variant' => 'Unisex',
                'category' => 'Jackets',
            ],
            [
                'product_name' => "Button-Up Shirt",
                'description' => 'Versatile button-up shirt suitable for both casual and formal occasions.',
                'excerpt' => 'Versatile button-up shirt',
                'img_filepath' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrl1ZAds6YsJ8XaPBV4_Y1QJAi0onqJj0YbEhWJ-KQ6w&s",
                'price' => 34.99,
                'stock' => 55,
                'size' => 'L',
                'variant' => 'Male',
                'category' => 'Shirts',
            ],
            [
                'product_name' => "Printed Dress",
                'description' => 'Chic printed dress with vibrant colors and stylish design.',
                'excerpt' => 'Chic printed dress',
                'img_filepath' => "https://media2.newlookassets.com/i/newlook/672397409M9/womens/clothing/dresses/blue-floral-high-frill-neck-midi-dress.jpg",
                'price' => 59.99,
                'stock' => 45,
                'size' => 'S',
                'variant' => 'Female',
                'category' => 'Dresses',
            ],
            [
                'product_name' => "Cargo Pants",
                'description' => 'Stylish and functional cargo pants with multiple pockets.',
                'excerpt' => 'Stylish cargo pants',
                'img_filepath' => "https://images.only.com/15301004/4336933/001/only-regularfitelasticatedhemscargotrousers-brown.jpg?v=aeb58d3bf1c4d6d12c6cb79c159bb64d&format=webp&width=1280&quality=90&key=25-0-3",
                'price' => 54.99,
                'stock' => 35,
                'size' => 'M',
                'variant' => 'Male',
                'category' => 'Pants',
            ],
            [
                'product_name' => "Knit Beanie",
                'description' => 'Warm and cozy knit beanie to keep you stylishly warm in winter.',
                'excerpt' => 'Warm knit beanie',
                'img_filepath' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlys9H_KHpv7XUBC371OUnRpZzToSfL7AIwtDUsGFOEw&s",
                'price' => 19.99,
                'stock' => 90,
                'size' => 'M',
                'variant' => 'Unisex',
                'category' => 'Accessories',
            ],
            [
                'product_name' => "Graphic Hoodie",
                'description' => 'Trendy graphic hoodie with unique design elements.',
                'excerpt' => 'Trendy graphic hoodie',
                'img_filepath' => "https://images.only.com/15247208/3785975/001/only-solidcoloredlogohoodie-black.jpg?v=4dab2effb4821416b8f02648fe122445&format=webp&width=1280&quality=90&key=25-0-3",
                'price' => 49.99,
                'stock' => 75,
                'size' => 'M',
                'variant' => 'Unisex',
                'category' => 'Sweatshirts',
            ],
            [
                'product_name' => "Suede Loafers",
                'description' => 'Elegant suede loafers for a sophisticated look.',
                'excerpt' => 'Elegant suede loafers',
                'img_filepath' => "https://cdn11.bigcommerce.com/s-xxpf5j1erh/images/stencil/1280x1280/products/2241/13358/Untitled_design_5__92014.1651098148.png?c=1",
                'price' => 79.99,
                'stock' => 23,
                'size' => 'L',
                'variant' => 'Male',
                'category' => 'Shoes',
            ],


        ];
        DB::table('products')->insert($products);
    }
}
