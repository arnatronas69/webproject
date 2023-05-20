<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Manufacturer;
use Database\Factories\TagFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed categories
        $categories = ['Shirts', 'Pants', 'Shoes', 'Accessories'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // Seed manufacturers
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Manufacturer::create(['name' => $faker->unique()->company]);
        }

        // Seed products
        $faker = \Faker\Factory::create();

        foreach (Category::all() as $category) {
            for ($i = 0; $i < 5; $i++) {
                $product = Product::create([
                    'name' => $faker->word,
                    'description' => $faker->paragraph,
                    'category_id' => $category->id,
                    'manufacturer_id' => Manufacturer::inRandomOrder()->first()->id,
                    'price' => $faker->randomFloat(2, 100, 1000),
                ]);

                // Seed tags
                $tags = TagFactory::new()->count(3)->create();

                $product->tags()->attach($tags);
            }
        }
    }
}


