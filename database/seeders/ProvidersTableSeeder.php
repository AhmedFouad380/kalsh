<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::create([
            'name' => 'provider1',
            'phone' => '96611111111',
            'email' => 'provider1@gmail.com',
            'status' => 'active',
            'online' => 1,
            'password' => 123456,
            'rate' => '3.5',
            'lat' => '31.1',
            'lng' => '30.2',
        ]);

        Provider::create([
            'name' => 'provider2',
            'phone' => '96622222222',
            'email' => 'provider2@gmail.com',
            'status' => 'active',
            'online' => 1,
            'password' => 123456,
            'rate' => '3.5',
            'lat' => '29.1',
            'lng' => '24.5',
        ]);

        Provider::create([
            'name' => 'provider3',
            'phone' => '96633333333',
            'email' => 'provider3@gmail.com',
            'status' => 'active',
            'online' => 1,
            'password' => 123456,
            'rate' => '3.5',
            'lat' => '24.6',
            'lng' => '29.3',
        ]);

        Provider::create([
            'name' => 'provider4',
            'phone' => '96644444444',
            'email' => 'provider4@gmail.com',
            'status' => 'active',
            'online' => 1,
            'password' => 123456,
            'rate' => '3.5',
            'lat' => '34.6',
            'lng' => '33.3',
        ]);
    }
}
