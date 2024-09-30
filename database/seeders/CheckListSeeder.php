<?php

namespace Database\Seeders;

use App\Models\CheckList;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CheckListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 6; $i++) {
            CheckList::create([
                'task_id'       => rand(1, 30),
                'created_by'    => rand(1, 10),
                'content'       => $faker->sentence,
                'assigned'      => rand(1, 10)
            ]);
        }
    }
}
