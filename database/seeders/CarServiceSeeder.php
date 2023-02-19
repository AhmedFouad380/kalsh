<?php

namespace Database\Seeders;

use App\Models\CarService;
use App\Models\ReadyService;
use Illuminate\Database\Seeder;

class CarServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carServiceNames = [
            ['id' => 1, 'name_ar' => 'بنزين', 'name_en' => 'petrol'],
            ['id' => 2, 'name_ar' => 'بطارية', 'name_en' => 'battery'],
            ['id' => 3, 'name_ar' => 'سطحة', 'name_en' => 'flatness'],
            ['id' => 4, 'name_ar' => 'بنشر', 'name_en' => 'Post'],
            ['id' => 5, 'name_ar' => 'فتح قفل السيارة', 'name_en' => 'Unlock the car'],
            ['id' => 6, 'name_ar' => 'غسيل السياره', 'name_en' => 'Car wash'],
            ['id' => 7, 'name_ar' => 'تلميع كفرات', 'name_en' => 'Tire polishing'],
        ];

        foreach ($carServiceNames as $key => $carServiceName) {
            CarService::updateOrCreate([
                'id' => $carServiceName['id'],
                'name_ar' => $carServiceName['name_ar'],
                'name_en' => $carServiceName['name_en'],
                'sort' => $key + 1,
            ]);
        }

//        child rows


        $carServiceNamesChilds = [
            ['id' => 8, 'name_ar' => 'جركن واحد  بنزين', 'name_en' => 'One jerrycan of petrol', 'parent_id' => 1],
            ['id' => 9, 'name_ar' => 'جركنين  بنزين', 'name_en' => 'Gherkinine benzene', 'parent_id' => 1],
            ['id' => 10, 'name_ar' => 'اشتراك بطارية', 'name_en' => 'battery subscription', 'parent_id' => 2],
            ['id' => 11, 'name_ar' => 'تغيير بطارية', 'name_en' => 'battery change', 'parent_id' => 2],
        ];

        foreach ($carServiceNamesChilds as $key => $carServiceNameChild) {
            CarService::updateOrCreate([
                'id' => $carServiceNameChild['id'],
                'name_ar' => $carServiceNameChild['name_ar'],
                'name_en' => $carServiceNameChild['name_en'],
                'parent_id' => $carServiceNameChild['parent_id'],
                'sort' => $key + 1,
            ]);
        }
    }
}
