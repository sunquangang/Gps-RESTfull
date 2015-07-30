<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Point;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        //User::truncate();

        foreach(range(1,10) as $index)  
        {  
            User::create([  
                'name' => str_replace('.', '_', $faker->unique()->userName),  
                'email' => $faker->email,  
                'password' => 'password', 
            ]);  
        }

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
