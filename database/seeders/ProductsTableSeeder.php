<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Sarung Tisu',
                'price' => 10000,
                'stock' => 10,
                'category' => 'Category 1',
                'size' => json_encode(['S', 'M', 'L']),
                'image' => json_encode(['image1.jpg', 'image2.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'price' => 20000,
                'stock' => 20,
                'category' => 'Category 2',
                'size' => json_encode(['M', 'L', 'XL']),
                'image' => json_encode(['image3.jpg', 'image4.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan produk lainnya jika diperlukan
        ]);
    }
}
