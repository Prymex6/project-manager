<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Project\ProjectStatus;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        ProjectStatus::create([
            'name' => 'In Progress',
            'color' => '#fff'
        ]);

        ProjectStatus::create([
            'name' => 'Not Started',
            'color' => '#fff'
        ]);

        for ($i = 1; $i <= 7; $i++) {
            $project = Project::create([
                'name'          =>  $faker->word(),
                'company_id'    =>  rand(1, 4),
                'description'   =>  $faker->paragraph,
                'tags'          =>  implode(',', ($faker->words(3))),
                'status_id'     =>  rand(1, 2),
                'started_at'    =>  now(),
                'deadline_at'   =>  now()->addMonths(1),
            ]);
            $project->settings()->create([
                'min_hours'                 =>  rand(50, 100),
                'max_hours'                 =>  rand(120, 200),
                'visible_tabs'              =>  json_encode(['tasks, files']),
                'hide_tasks_on_main_table'  =>  $faker->boolean,
                'created_at'                =>  now(),
            ]);

            for ($j = 1; $j <= rand(1, 3); $j++) {
                $project->users()->attach([rand(1, 10)]);

                $project->groups()->attach([rand(1, 5)]);
            }
        }
    }
}
