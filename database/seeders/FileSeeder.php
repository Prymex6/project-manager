<?php

namespace Database\Seeders;

use App\Models\File;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 27; $i++) {
            $file = File::create([
                'project_id'    =>  rand(1, 7),
                'uploaded_by'   =>  rand(1, 10),
                'name'          =>  $faker->word() . '.png',
                'type'          =>  'png',
                'subject'       =>  $faker->sentence,
                'description'   =>  $faker->paragraph,
                'download'      =>  rand(1, 23),
            ]);

            for ($j = 1; $j <= rand(1, 3); $j++) {
                $file->comments()->attach(rand(1, 66));

                $file->users()->attach([rand(1, 10) => ['permission' => null]]);

                $file->groups()->attach([rand(1, 5) => ['permission' => null]]);
            }
        }
    }
}
