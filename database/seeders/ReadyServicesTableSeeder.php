<?php

namespace Database\Seeders;

use App\Models\ReadyService;
use Illuminate\Database\Seeder;

class ReadyServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $readyServiceNames = [
            ['name_ar' => 'المطبخ','name_en' => 'Kitchen'],
            ['name_ar' => 'اللغات','name_en' => 'Languages'],
            ['name_ar' => 'التكنولوجيا','name_en' => 'Technology'],
            ['name_ar' => 'الرياضة والصحة','name_en' => 'Health and Sport'],
            ['name_ar' => 'مدرس خصوصي','name_en' => 'Private Teacher'],
            ['name_ar' => 'طبيب منزلي','name_en' => 'Home Doctor'],
            ['name_ar' => 'العناية بالرجل','name_en' => 'Man Care'],
            ['name_ar' => 'العناية بالمرأة','name_en' => 'Woman Care'],
            ['name_ar' => 'العناية بالطفل','name_en' => 'Child Care'],
            ['name_ar' => 'علم النفس','name_en' => 'Psychology'],
            ['name_ar' => 'علم الإجتماع','name_en' => 'Sociology'],
            ['name_ar' => 'القانون','name_en' => 'Law'],
            ['name_ar' => 'الثقافة والفنون','name_en' => 'Culture and Arts'],
            ['name_ar' => 'الأدب','name_en' => 'Literature'],
            ['name_ar' => 'التسوق','name_en' => 'Shopping'],
            ['name_ar' => 'التجارة','name_en' => 'Commerce'],
            ['name_ar' => 'السياحة','name_en' => 'Tourism'],
            ['name_ar' => 'الإدارة','name_en' => 'Management'],
            ['name_ar' => 'الترفيه','name_en' => 'Entertainment'],
            ['name_ar' => 'تربية الحيوانات','name_en' => 'Animal Husbandry'],
            ['name_ar' => 'الموروث الشعبي','name_en' => 'Popular Heritage'],
            ['name_ar' => 'مهارات اخري','name_en' => 'Other Skills']
        ];

        foreach ($readyServiceNames as $key => $readyServiceName){
            ReadyService::create([
                'name_ar' => $readyServiceName['name_ar'],
                'name_en' => $readyServiceName['name_en'],
                'image' => ($key+1).".png",
                'sort' => $key+1,
                'is_checked' => $key == 21 ? 1 : 0,
            ]);
        }
    }
}
