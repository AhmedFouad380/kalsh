<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name_ar' => 'خدمات التوصيل',
            'name_en' => 'Delivery Services',
            'image' => '1.png',
            'sort' => '1',
            'is_provider' => '1',
        ]);

        Service::create([
            'name_ar' => 'ليموزين',
            'name_en' => 'Limousine',
            'image' => '2.png',
            'sort' => '2',
            'is_provider' => '2',
        ]);

        Service::create([
            'name_ar' => 'خدمات السيارات',
            'name_en' => 'Cars Services',
            'image' => '3.png',
            'sort' => '3',
            'is_provider' => '3',
        ]);

        Service::create([
            'name_ar' => 'مستعد',
            'name_en' => 'Ready',
            'image' => '4.png',
            'sort' => '4',
            'is_provider' => '1',
        ]);

        Service::create([
            'name_ar' => 'تعبير رؤي',
            'name_en' => 'Dreams Interpretation',
            'image' => '5.png',
            'sort' => '5',
            'is_provider' => '1',
            'price' => 30,
        ]);

        Service::create([
            'name_ar' => 'متاجر إلكترونية',
            'name_en' => 'Electronic Stores',
            'image' => '6.png',
            'sort' => '6',
        ]);

        Service::create([
            'name_ar' => 'صحف إلكترونية',
            'name_en' => 'Electronic newspapers',
            'image' => '7.png',
            'sort' => '7',
        ]);

        Service::create([
            'name_ar' => 'مواعيد الصلاة',
            'name_en' => 'Prayer Times',
            'image' => '8.png',
            'sort' => '8',
        ]);

        Service::create([
            'name_ar' => 'أحوال الطقس',
            'name_en' => 'Weather Conditions',
            'image' => '9.png',
            'sort' => '9',
        ]);

        Service::create([
            'name_ar' => 'أرقام تهمك',
            'name_en' => 'Important Numbers',
            'image' => '10.png',
            'sort' => '10',
        ]);
    }
}
