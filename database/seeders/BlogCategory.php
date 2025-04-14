<?php

namespace Database\Seeders;

use App\Models\BlogCategory as ModelsBlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        ModelsBlogCategory::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 5; $i++) {
            ModelsBlogCategory::create([
                'name' => $faker->sentence,
            ]);
        }
    }
}
