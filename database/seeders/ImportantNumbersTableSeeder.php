<?php

namespace Database\Seeders;

use App\Models\ImportantNumber;
use Illuminate\Database\Seeder;

class ImportantNumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImportantNumber::create([
            'name_ar' => 'الشرطة',
            'name_en' => 'Police',
            'number' => '999',
            'sort' => '2',
        ]);

        ImportantNumber::create([
            'name_ar' => 'الدفاع المدني',
            'name_en' => 'Civil Defense',
            'number' => '998',
            'sort' => '1',
        ]);

        ImportantNumber::create([
            'name_ar' => 'الإسعاف',
            'name_en' => 'Ambulance',
            'number' => '997',
            'sort' => '3',
        ]);

        ImportantNumber::create([
            'name_ar' => 'الحوادث المرورية',
            'name_en' => 'Traffic Accidents',
            'number' => '993',
            'sort' => '4',
        ]);

        ImportantNumber::create([
            'name_ar' => 'أمن الطرق',
            'name_en' => 'Roads Security',
            'number' => '996',
            'sort' => '5',
        ]);

        ImportantNumber::create([
            'name_ar' => 'حرس الحدود',
            'name_en' => 'Border Guard',
            'number' => '994',
            'sort' => '6',
        ]);
    }
}
