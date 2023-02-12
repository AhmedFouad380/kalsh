<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Admin::where('phone','96611111111')->first()){
            Admin::create([
                'name' => 'admin',
                'phone' => '96611111111',
                'email' => 'admin@gmail.com',
                'password' => '123456',
                'email_verified_at' => Carbon::now(),
                'status' => 'active'
            ]);
        }

    }
}
