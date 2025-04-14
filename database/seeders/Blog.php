<?php

namespace Database\Seeders;

use App\Models\Blog as ModelsBlog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Blog extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        ModelsBlog::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        $title = $faker->sentence;
        $slug = str_replace(' ', '-', strtolower($title));
        for ($i = 0; $i < 10; $i++) {
            ModelsBlog::create([
                'category_id' => $faker->numberBetween(1, 5),
                'title' => $title,
                'slug' => $slug,
                'image' => $faker->imageUrl,
                'description' => $faker->paragraph,
                'content' => $faker->paragraph,
                'published_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
