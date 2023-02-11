<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('phone', '96611111111')->first()) {
            User::create([
                'name' => 'customer',
                'phone' => '96612345678',
                'email' => 'customer@gmail.com',
                'status' => 'active',
                'rate' => '3.5',
            ]);
        }
    }
}
