<?php

namespace Database\Seeders;

use App\Models\Activity;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 200; $i++) {
            Activity::create([
                'project_id'    => rand(1, 7),
                'task_id'       => rand(1, 30),
                'created_by'    => rand(1, 10),
                'type'          => $faker->word(),
                'content'       => $faker->paragraph,
            ]);
        }
    }
}
