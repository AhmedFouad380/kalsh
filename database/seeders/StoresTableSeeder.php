<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'name_ar' => 'متجر 1',
            'name_en' => 'Store 1',
            'image' => '1.png',
            'sort' => '1',
            'url' => 'https://www.store.com',
        ]);

        Store::create([
            'name_ar' => 'متجر 2',
            'name_en' => 'Store 2',
            'image' => '2.png',
            'sort' => '2',
            'url' => 'https://www.store.com',
        ]);

        Store::create([
            'name_ar' => 'متجر 3',
            'name_en' => 'Store 3',
            'image' => '3.png',
            'sort' => '3',
            'url' => 'https://www.store.com',
        ]);

        Store::create([
            'name_ar' => 'متجر 4',
            'name_en' => 'Store 4',
            'image' => '4.png',
            'sort' => '4',
            'url' => 'https://www.store.com',
        ]);

        Store::create([
            'name_ar' => 'متجر 5',
            'name_en' => 'Store 5',
            'image' => '5.png',
            'sort' => '5',
            'url' => 'https://www.store.com',
        ]);

        Store::create([
            'name_ar' => 'متجر 6',
            'name_en' => 'Store 6',
            'image' => '6.png',
            'sort' => '6',
            'url' => 'https://www.store.com',
        ]);

        Store::create([
            'name_ar' => 'متجر 7',
            'name_en' => 'Store 7',
            'image' => '7.png',
            'sort' => '7',
            'url' => 'https://www.store.com',
            'status' => 'inactive'
        ]);
    }
}
