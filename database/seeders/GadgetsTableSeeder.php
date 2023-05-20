<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GadgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $manufacturers = DB::table('manufacturers')->pluck('id');

        foreach (range(1, 10) as $index) {
            $gadget = [
                'name' => $faker->word,
                'type' => $faker->randomElement(['Phone', 'Tablet', 'Laptop']),
                'created_at' => now(),
                'updated_at' => now(),
                'manufacturer_id' => $faker->randomElement($manufacturers),
            ];

            DB::table('gadgets')->insert($gadget);
        }
    }
}
