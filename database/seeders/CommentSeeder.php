<?php

namespace Database\Seeders;

use App\Models\Comment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 66; $i++) {
            $comment = Comment::create([
                'created_by'    => rand(1, 10),
                'content'       => $faker->sentence,
            ]);

            $comment->tasks()->attach(rand(1, 30));
        }
    }
}
