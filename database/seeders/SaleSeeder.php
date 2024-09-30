<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Sale\SaleStatus;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        SaleStatus::create([
            'name' => 'Paid',
            'color' => '#fff'
        ]);

        SaleStatus::create([
            'name' => 'Unpaid',
            'color' => '#fff'
        ]);

        for ($i = 1; $i <= 10; $i++) {
            Sale::create([
                'project_id'    =>  rand(1, 7),
                'company_id'    =>  rand(1, 2),
                'user_id'       =>  rand(1, 10),
                'subject'       =>  $faker->sentence,
                'description'   =>  $faker->paragraph,
                'type'          =>  $faker->word(),
                'total'         =>  rand(500, 10000),
                'status_id'     =>  rand(1, 2),
            ]);
        }
    }
}
