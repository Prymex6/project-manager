<?php

namespace Database\Seeders;

use App\Models\Attachment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 15; $i++) {
            Attachment::create([
                'ticket_id' =>  rand(1, 20),
                'path'      =>  $faker->url
            ]);
        }
    }
}
