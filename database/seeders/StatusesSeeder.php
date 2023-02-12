<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
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
                'name' => 'rejected',
            ],
        ];

        foreach ($data as $get) {
            Status::updateOrCreate($get);
        }

    }
}
