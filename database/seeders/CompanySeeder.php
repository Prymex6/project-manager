<?php

namespace Database\Seeders;

use App\Models\Company;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 2; $i++) {
            Company::create([
                'name'          => $faker->sentence,
                'description'   => $faker->paragraph,
                'telephone'     => $faker->phoneNumber,
                'website'       => $faker->domainName,
            ]);
        }
    }
}
