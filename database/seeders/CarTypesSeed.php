<?php

namespace Database\Seeders;

use App\Models\CarType;
use App\Models\CarTypePrice;
use Illuminate\Database\Seeder;

class CarTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carTypes = [
            ['id' => 1, 'name_ar' => 'سيارة توفير', 'name_en' => 'saving car ', 'start_price' => 9.0, "image" => "1.png"],
            ['id' => 2, 'name_ar' => 'سيارة كَلش', 'name_en' => 'klsh car', 'start_price' => 12.0, "image" => "2.png"],
            ['id' => 3, 'name_ar' => 'سيارة عائلية', 'name_en' => 'family car', 'start_price' => 16.0, "image" => "3.png"],
            ['id' => 4, 'name_ar' => 'سيارة فارهة', 'name_en' => 'luxury car', 'start_price' => 21.0, "image" => "4.png"],
        ];

        CarType::insert($carTypes);

        $carTypePrices = [
            //saving car
            ['car_type_id' => 1, 'from' => 0, 'to' => 1.99, "price_per_km" => 0],
            ['car_type_id' => 1, 'from' => 2, 'to' => 6.99, "price_per_km" => 2],
            ['car_type_id' => 1, 'from' => 7, 'to' => 12.99, "price_per_km" => 1.6],
            ['car_type_id' => 1, 'from' => 13, 'to' => 60.99, "price_per_km" => 1.4],
            ['car_type_id' => 1, 'from' => 61, 'to' => 1000000, "price_per_km" => 1.2],
            //klsh car
            ['car_type_id' => 2, 'from' => 0, 'to' => 1.99, "price_per_km" => 0],
            ['car_type_id' => 2, 'from' => 2, 'to' => 6.99, "price_per_km" => 2],
            ['car_type_id' => 2, 'from' => 7, 'to' => 12.99, "price_per_km" => 1.7],
            ['car_type_id' => 2, 'from' => 13, 'to' => 60.99, "price_per_km" => 1.5],
            ['car_type_id' => 2, 'from' => 61, 'to' => 1000000, "price_per_km" => 1.3],

            //family car
            ['car_type_id' => 3, 'from' => 0, 'to' => 1.99, "price_per_km" => 0],
            ['car_type_id' => 3, 'from' => 2, 'to' => 6.99, "price_per_km" => 2],
            ['car_type_id' => 3, 'from' => 7, 'to' => 12.99, "price_per_km" => 1.8],
            ['car_type_id' => 3, 'from' => 13, 'to' => 60.99, "price_per_km" => 1.6],
            ['car_type_id' => 3, 'from' => 61, 'to' => 1000000, "price_per_km" => 1.4],


            //luxury car
            ['car_type_id' => 3, 'from' => 0, 'to' => 1.99, "price_per_km" => 0],
            ['car_type_id' => 3, 'from' => 2, 'to' => 6.99, "price_per_km" => 2],
            ['car_type_id' => 3, 'from' => 7, 'to' => 12.99, "price_per_km" => 1.9],
            ['car_type_id' => 3, 'from' => 13, 'to' => 60.99, "price_per_km" => 1.7],
            ['car_type_id' => 3, 'from' => 61, 'to' => 1000000, "price_per_km" => 1.5],
        ];
        CarTypePrice::insert($carTypePrices);


    }
}
