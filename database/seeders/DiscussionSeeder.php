<?php

namespace Database\Seeders;

use App\Models\Discussion;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 15; $i++) {
            $discussion = Discussion::create([
                'project_id'    => rand(1, 7),
                'created_by'    => rand(1, 10),
                'subject'       => $faker->sentence,
                'description'   => $faker->paragraph,
            ]);

            for ($j = 1; $j <= rand(1, 3); $j++) {
                $discussion->comments()->attach(rand(1, 66));

                $discussion->users()->attach([rand(1, 10)]);

                $discussion->groups()->attach([rand(1, 5)]);
            }
        }
    }
}
