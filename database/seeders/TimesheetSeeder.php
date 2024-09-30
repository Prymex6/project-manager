<?php

namespace Database\Seeders;

use App\Models\Timesheet;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 200; $i++) {
            Timesheet::create([
                'project_id'    =>  rand(1, 7),
                'user_id'       =>  rand(1, 10),
                'task_id'       =>  rand(1, 30),
                'tags'          =>  implode(',', ($faker->words(3))),
                'note'          =>  $faker->sentence,
                'hours'         =>  rand(1, 8),
                'started_at'    =>  now(),
                'ended_at'      =>  now()->addHour(rand(1, 8)),
            ]);
        }
    }
}
