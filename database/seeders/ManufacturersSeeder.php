<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ManufacturersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('manufacturers')->insert([
                'name' => $faker->company,
                'website' => $faker->url,
                'email' => $faker->email,
                'country' => $faker->country,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
