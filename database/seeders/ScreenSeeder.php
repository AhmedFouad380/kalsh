<?php

namespace Database\Seeders;

use App\Models\Screen;
use Illuminate\Database\Seeder;

class ScreenSeeder extends Seeder
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
                'name_ar' => 'كـلّـش',
                'name_en' => 'klash',
                'body_ar' => 'لن تحتاج لأكثر من تطبيق لتوفر ما يلزمك، فكل ما تحتاجه ستجده في تطبيق واحدً',
                'body_en' => 'You will not need more than one application to provide what you need, as everything you need will be found in one application',
                'image' => '1.png',
            ],
            [
                'name_ar' => 'اشتراك سنوي',
                'name_en' => 'yearly subscription',
                'body_ar' => 'التطبيق الأول من نوعه في المملكة العربية السعودية كـسوبر أبً',
                'body_en' => 'The first application of its kind in the Kingdom of Saudi Arabia as a Super App',
                'image' => '2.png',
            ],
            [
                'name_ar' => 'الدوري الإنجليزي',
                'name_en' => 'Premier League',
                'body_ar' => 'لا تدع مباريات فريقك المفضل تفوتك، استمتع بها أينما كنت ',
                'body_en' => 'Don\'t miss out on your favorite team\'s matches, enjoy them wherever you are',
                'image' => '3.png',
            ],
        ];
        foreach ($data as $get) {
            Screen::updateOrCreate($get);
        }
    }
}
