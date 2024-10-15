<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Task\TaskPriority;
use App\Models\Task\TaskStatus;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        TaskStatus::create([
            'name' => 'In Progress',
            'color' => '#fff'
        ]);

        TaskStatus::create([
            'name' => 'Not Started',
            'color' => '#fff'
        ]);

        TaskPriority::create([
            'name' => 'Low',
            'color' => '#fff'
        ]);

        TaskPriority::create([
            'name' => 'Medium',
            'color' => '#fff'
        ]);

        TaskPriority::create([
            'name' => 'High',
            'color' => '#fff'
        ]);

        for ($i = 1; $i <= 30; $i++) {
            $task = Task::create([
                'name'          =>  $faker->word(),
                'project_id'    =>  rand(1, 7),
                'created_by'    =>  rand(1, 10),
                'description'   =>  $faker->paragraph,
                'tags'          =>  implode(',', ($faker->words(3))),
                'is_private'    =>  $faker->boolean,
                'status_id'     =>  rand(1, 2),
                'priority_id'   =>  rand(1, 3),
                'planned_hours' =>  rand(1, 15),
                'started_at'    =>  now(),
                'deadline_at'   =>  now()->addMonths(rand(1, 3))
            ]);

            for ($j = 1; $j <= rand(1, 3); $j++) {
                $task->users()->attach([rand(1, 10)]);

                $task->groups()->attach([rand(1, 5)]);
            }
        }
    }
}
