<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name_ar' => 'الرياض',
            'name_en' => 'Riyadh',
            'image' => 'active',
        ]);
        City::create([
            'name_ar' => 'المدينة المنورة',
            'name_en' => 'Medina',
            'image' => 'active',
        ]);
        City::create([
            'name_ar' => 'مكة',
            'name_en' => 'Mecca',
            'image' => 'active',
        ]);
        City::create([
            'name_ar' => 'القصيم',
            'name_en' => 'Al-Qassim',
            'image' => 'active',
        ]);
        City::create([
            'name_ar' => 'تبوك',
            'name_en' => 'Tabuk',
            'image' => 'active',
        ]);
    }
}
