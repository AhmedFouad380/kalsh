<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
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
                'name' => 'pending',
            ],
            [
                'name' => 'accepted',
            ],
            [
                'name' => 'canceled_by_user',
            ],
            [
                'name' => 'canceled_by_system',
            ],
            [
                'name' => 'canceled_by_provider',
            ],
            [
                'name' => 'completed',
            ],
            [
                'name' => 'un_known',
            ],
            [
                'name' => 'rejected_by_user',
            ],
            [
                'name' => 'rejected_by_provider',
            ],
            [
                'name' => 'start',
            ],
            [
                'name' => 'arrived',
            ],
        ];

        foreach ($data as $get) {
            Status::updateOrCreate($get);
        }
    }
}
