<?php

namespace Database\Seeders;

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
        $this->call(StatusesSeeder::class);
    }
}
