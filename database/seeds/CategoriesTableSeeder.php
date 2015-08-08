<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Point;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Category::truncate();

        foreach(range(1,10) as $index)
        {
            Category::create([
                'name' => $faker->word,
            ]);
        }

        Point::truncate();
        foreach(range(1,50) as $index)
        {
            Point::create([
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'created_by' => 1, // user:arelstone
            ]);
        }
    }
}
