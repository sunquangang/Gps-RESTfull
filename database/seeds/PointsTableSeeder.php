<?php

use Illuminate\Database\Seeder;

class PointsTableSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {

       $loop = 10;
       $faker = $this->getFaker();

$users = \App\User::all();



       for ($i = 0; $i < $loop; $i++)
       {
          $user_id = array_rand($users->toArray(), 1);
           print 'User id: ' . $user_id;
           $name = $faker->sentence();
           $description = $faker->paragraph($nbSentences = $faker->randomDigitNotNull);
           $longitude = $faker->longitude;
           $latitude = $faker->latitude;
           $coordinates = $longitude . ',' . $latitude;

          $arr = [
            "name" => $name,
            "description" => $description,
            "longitude" => $longitude,
            "latitude" => $latitude,
            "coordinates" => $coordinates,
            "created_by" => $user_id,
            "updated_by" => $user_id,
          ];

          var_dump($arr);

           \App\Point::create($arr);

           echo 'Point was created by: ' . $user_id;
           var_dump($arr);
       }
     }
}
