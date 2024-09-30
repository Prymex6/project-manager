<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            Schedule::create([
                'user_id'       =>  rand(1, 10),
                'created_by'    =>  rand(1, 10),
                'title'         =>  $faker->sentence,
                'hours'         =>  rand(6, 8),
                'started_at'    =>  now(),
                'ended_at'      =>  now()->addHour(rand(6, 8))
            ]);
        }
    }
}
