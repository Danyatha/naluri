<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Story;
use Carbon\Carbon;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Story::create([
            'title'   => 'Menemukan Naluri Hidup',
            'slug'    => 'menemukan-naluri-hidup',
            'category' => 'Inspirasi',
            'excerpt' => 'Setiap orang memiliki naluri yang membimbing mereka dalam perjalanan hidup. Namun, bagaimana cara menemukannya?',
            'author'  => 'Dany',
            'date'    => Carbon::now()->subDays(5),
            'content' => '
        Dalam perjalanan hidup, setiap orang pasti bertemu dengan titik di mana
        mereka merasa terjebak dan kehilangan arah. Namun, justru di saat-saat
        itulah kekuatan sejati mulai terlihat.
    ',
            'closing' => '
        Pada akhirnya, perjalanan kita bukan tentang seberapa cepat kita sampai,
        melainkan seberapa banyak kita belajar sepanjang jalan.
    ',
        ]);
    }
}
