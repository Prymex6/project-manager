<?php

namespace Database\Seeders;

use App\Models\Group;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            $group = Group::create([
                'name'          => $faker->company,
                'description'   => $faker->paragraph,
                'color'         => '#fe3251'
            ]);

            $group->users()->attach(rand(1, 10));
        }
    }
}
