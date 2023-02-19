<?php

namespace Database\Seeders;

use App\Http\Controllers\Api\PageController;
use App\Http\Resources\CitiesResource;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $this->call(AdminsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ReadyServicesTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(ImportantNumbersTableSeeder::class);
        $this->call(ScreenSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CarServiceSeeder::class);
    }
}
