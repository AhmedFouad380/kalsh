<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'name_ar' => 'استمتع بمشاهدة الدوري السعودي والدوريات العالمية مجاناً',
            'name_en' => 'Enjoy watching the Saudi League and international leagues for free',
            'image' => '1.png',
            'type' => Slider::HOME_TYPE,
        ]);

        Slider::create([
            'name_ar' => 'تخفيضات تصل إلي 50 %',
            'name_en' => 'Discounts up to 50%',
            'image' => '2.png',
            'type' => Slider::STORES_TYPE,
        ]);

        Slider::create([
            'name_ar' => 'اللهم اغفر للمؤمنين والمؤمنات الاحياء منهم والاموات',
            'name_en' => 'Oh God, forgive the believers, men and women living and dead',
            'image' => '3.png',
            'type' => Slider::PRAY_TYPE,
        ]);

    }
}
