<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::create([
            'name_ar' => 'صحيفة 1',
            'name_en' => 'Page 1',
            'image' => '1.png',
            'sort' => '1',
            'url' => 'https://www.page.com',
        ]);

        News::create([
            'name_ar' => 'صحيفة 2',
            'name_en' => 'Page 2',
            'image' => '2.png',
            'sort' => '2',
            'url' => 'https://www.page.com',
        ]);

        News::create([
            'name_ar' => 'صحيفة 3',
            'name_en' => 'Page 3',
            'image' => '3.png',
            'sort' => '3',
            'url' => 'https://www.page.com',
        ]);

        News::create([
            'name_ar' => 'صحيفة 4',
            'name_en' => 'Page 4',
            'image' => '4.png',
            'sort' => '4',
            'url' => 'https://www.page.com',
        ]);

        News::create([
            'name_ar' => 'صحيفة 5',
            'name_en' => 'Page 5',
            'image' => '5.png',
            'sort' => '5',
            'url' => 'https://www.page.com',
        ]);

        News::create([
            'name_ar' => 'صحيفة 6',
            'name_en' => 'Page 6',
            'image' => '6.png',
            'sort' => '6',
            'url' => 'https://www.page.com',
        ]);

        News::create([
            'name_ar' => 'صحيفة 7',
            'name_en' => 'Page 7',
            'image' => '7.png',
            'sort' => '7',
            'url' => 'https://www.page.com',
            'status' => 'inactive'
        ]);
    }
}
