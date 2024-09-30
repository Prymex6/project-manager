<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Event\EventStatus;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        EventStatus::create([
            'name' => 'Expectation',
            'color' => '#fff'
        ]);

        EventStatus::create([
            'name' => 'Accepted',
            'color' => '#fff'
        ]);

        EventStatus::create([
            'name' => 'Rejected',
            'color' => '#fff'
        ]);

        for ($i = 1; $i <= 7; $i++) {
            Event::create([
                'user_id'       =>  rand(1, 10),
                'created_by'    =>  rand(1, 10),
                'title'         =>  $faker->sentence,
                'description'   =>  $faker->paragraph,
                'tags'          =>  implode(',', ($faker->words(3))),
                'status_id'     =>  rand(1, 3),
                'started_at'    =>  now(),
                'ended_at'      =>  now()->addMonths(1),
            ]);
        }
    }
}
