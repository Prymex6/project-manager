<?php

namespace Database\Seeders;

use App\Models\Note;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 24; $i++) {
            Note::create([
                'project_id'    =>  rand(1, 7),
                'created_by'    =>  rand(1, 10),
                'content'       =>  $faker->paragraph,
            ]);
        }
    }
}
