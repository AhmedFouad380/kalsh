<?php

namespace Database\Seeders;

use App\Models\DeliveryService;
use Illuminate\Database\Seeder;

class DeliveryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name_ar' => 'توصيل طلبات',
                'name_en' => 'Delivery orders',
                'commission' => 10,
                'min_cost' => 15,
                'kilo_cost' => 1,
                'min_distance' => 4,
                'range_shop' => 30,
                'range_provider' => 15,
                'range_provider_to_shop' => 10,
                'type' => 'delivery',
                'status' => 'active',
                'image' => 'delivery.png',
            ],
            [
                'id' => 2,
                'name_ar' => 'توصيل طرود',
                'name_en' => 'Delivery packages',
                'commission' => 10,
                'min_cost' => 15,
                'kilo_cost' => 1,
                'min_distance' => 4,
                'range_shop' => 30,
                'range_provider' => 15,
                'range_provider_to_shop' => 10,
                'type' => 'package',
                'status' => 'active',
                'image' => 'packages.png',
            ],
        ];
        foreach ($data as $get) {
            DeliveryService::updateOrCreate($get);
        }
    }
}
