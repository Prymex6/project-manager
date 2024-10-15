<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            $ticket = Ticket::create([
                'project_id'    =>  rand(1, 7),
                'created_by'    =>  rand(1, 10),
                'subject'       =>  $faker->sentence,
                'description'   =>  $faker->paragraph,
                'url'           =>  $faker->url,
                'status_id'     =>  rand(1, 2),
                'priority_id'   =>  rand(1, 3),
            ]);

            for ($j = 1; $j <= rand(1, 3); $j++) {
                $ticket->comments()->attach(rand(1, 66));

                $ticket->users()->attach([rand(1, 10)]);

                $ticket->groups()->attach([rand(1, 5)]);
            }
        }
    }
}
