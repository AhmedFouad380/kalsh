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
            ['name_ar' => 'بنزين','name_en' => 'Kitchen'],
            ['name_ar' => 'بطارية','name_en' => 'Kitchen'],
            ['name_ar' => 'سطحة','name_en' => 'Kitchen'],
            ['name_ar' => 'بنشر','name_en' => 'Kitchen'],
            ['name_ar' => 'فتح قفل السيارة','name_en' => 'Kitchen'],
            ['name_ar' => 'غسيل السياره','name_en' => 'Kitchen'],
            ['name_ar' => 'تلميع كفرات','name_en' => 'Kitchen'],
        ];

        foreach ($carServiceNames as $key => $readyServiceName){
            CarService::updateOrCreate([
                'name_ar' => $readyServiceName['name_ar'],
                'name_en' => $readyServiceName['name_en'],
                'sort' => $key+1,
            ]);
        }
    }
}
