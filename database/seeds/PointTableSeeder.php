<?php

use Illuminate\Database\Seeder;
use App\Point;
class PointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Point::truncate();
		foreach(range(1,50) as $index)  
        {  
            Point::create([  
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'created_by' => $faker->randomNumber(10),
                'created_at' => $fake->dateTime(),
            ]);  
        }
    }
}


