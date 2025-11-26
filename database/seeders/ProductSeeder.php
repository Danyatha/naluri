<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil kategori Kaos
        $categoryId = DB::table('categories')->where('name', 'Kaos')->first()->id_category;

        $products = [];

        for ($i = 1; $i <= 20; $i++) {
            $products[] = [
                'id_category' => $categoryId,
                'name'        => 'Kaos Premium ' . $i,
                'price'       => rand(85000, 250000),
                'description' => 'Kaos bahan premium, nyaman dipakai, edisi nomor ' . $i,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }
        $categoryId = DB::table('categories')->where('name', 'Jaket')->first()->id_category;
        $products = array_merge($products, []);
        for ($i = 1; $i <= 20; $i++) {
            $products[] = [
                'id_category' => $categoryId,
                'name'        => 'Jaket Premium ' . $i,
                'price'       => rand(150000, 500000),
                'description' => 'Jaket bahan premium, nyaman dipakai, edisi nomor ' . $i,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }
        DB::table('products')->insert($products);
    }
}
