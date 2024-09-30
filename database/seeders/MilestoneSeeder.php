<?php

namespace Database\Seeders;

use App\Models\Milestone;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MilestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 14; $i++) {
            $milestone = Milestone::create([
                'project_id'    =>  rand(1, 7),
                'created_by'    =>  rand(1, 10),
                'tags'          =>  implode(',', ($faker->words(3))),
                'name'          =>  $faker->sentence,
                'description'   =>  $faker->paragraph,
                'order'         =>  rand(1, 10)
            ]);

            $milestone->tasks()->attach([rand(1, 30) => ['added_by' => rand(1, 10), 'updated_by' => rand(1, 10)]]);
        }
    }
}
