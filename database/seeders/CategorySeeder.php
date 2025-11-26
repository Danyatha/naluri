<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kaos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kemeja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jaket',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);


        DB::table('categories')->insert($categories);
    }
}
