<?php

namespace Database\Seeders;

use App\Models\Chat;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            $chat = Chat::create([
                'title'         => $faker->sentence,
                'description'   => $faker->paragraph,
                'tags'          => implode(',', ($faker->words(3))),
            ]);

            for ($x = 1; $x <= rand(20, 50); $x++) {
                $chat->messages()->create(['user_id' => rand(1, 10), 'content' => $faker->sentence]);
            }

            for ($j = 1; $j <= rand(1, 3); $j++) {
                $chat->users()->attach([rand(1, 10) => ['permission' => null]]);

                $chat->groups()->attach([rand(1, 5) => ['permission' => null]]);
            }
        }
    }
}
