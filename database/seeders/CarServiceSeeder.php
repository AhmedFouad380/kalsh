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
            ['id' => 1, 'name_ar' => 'بنزين', 'name_en' => 'petrol', 'cost' => 10, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 2, 'name_ar' => 'بطارية', 'name_en' => 'battery', 'cost' => 0, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 3, 'name_ar' => 'سطحة', 'name_en' => 'flatness', 'cost' => 0, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 4, 'name_ar' => 'بنشر', 'name_en' => 'Post', 'cost' => 0, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 5, 'name_ar' => 'فتح قفل السيارة', 'name_en' => 'open and close the car', 'cost' => 60, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 6, 'name_ar' => 'غسيل السياره', 'name_en' => 'Car wash', 'cost' => 0, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 7, 'name_ar' => 'تلميع كفرات', 'name_en' => 'Tire polishing', 'cost' => 10, 'distance_cost' => 1, 'type' => 'one_way'],
        ];

        foreach ($carServiceNames as $key => $carServiceName) {
            CarService::updateOrCreate([
                'id' => $carServiceName['id'],
                'name_ar' => $carServiceName['name_ar'],
                'name_en' => $carServiceName['name_en'],
                'cost' => $carServiceName['cost'],
                'distance_cost' => $carServiceName['distance_cost'],
                'type' => $carServiceName['type'],
                'sort' => $key + 1,
            ]);
        }

//child rows
        $carServiceNamesChilds = [
            ['id' => 8, 'name_ar' => 'اشتراك بطارية', 'name_en' => 'battery subscription', 'parent_id' => 2, 'cost' => 15, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 9, 'name_ar' => 'تغيير بطارية', 'name_en' => 'battery change', 'parent_id' => 2, 'cost' => 30, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 10, 'name_ar' => 'سطحة عادية', 'name_en' => 'Normal surface', 'parent_id' => 3, 'cost' => 85, 'distance_cost' => 1, 'type' => 'two_ways'],
            ['id' => 11, 'name_ar' => 'سطحة هيدروليك', 'name_en' => 'Hydraulic surface', 'parent_id' => 3, 'cost' => 145, 'distance_cost' => 1, 'type' => 'two_ways'],
            ['id' => 12, 'name_ar' => 'اصلاح العجلة', 'name_en' => 'Wheel repair', 'parent_id' => 4, 'cost' => 35, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 13, 'name_ar' => 'تغيير العجلة', 'name_en' => 'Wheel change', 'parent_id' => 4, 'cost' => 25, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 14, 'name_ar' => 'سيارة صغيرة', 'name_en' => 'Small car', 'parent_id' => 6, 'cost' => 7, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 15, 'name_ar' => 'سيارة وسط', 'name_en' => 'middle car', 'parent_id' => 6, 'cost' => 11, 'distance_cost' => 1, 'type' => 'one_way'],
            ['id' => 16, 'name_ar' => 'سيارة كبيرة', 'name_en' => 'big car', 'parent_id' => 6, 'cost' => 14, 'distance_cost' => 1, 'type' => 'one_way'],
        ];

        foreach ($carServiceNamesChilds as $key => $carServiceNameChild) {
            CarService::updateOrCreate([
                'id' => $carServiceNameChild['id'],
                'name_ar' => $carServiceNameChild['name_ar'],
                'name_en' => $carServiceNameChild['name_en'],
                'parent_id' => $carServiceNameChild['parent_id'],
                'cost' => $carServiceNameChild['cost'],
                'distance_cost' => $carServiceNameChild['distance_cost'],
                'type' => $carServiceNameChild['type'],
                'sort' => $key + 1,
            ]);
        }
    }
}
