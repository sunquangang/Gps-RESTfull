<?php


class PointsTableSeeder extends DatabaseSeeder
{
     /**
      * Run the database seeds.
      */
     public function run()
     {
         $loop = 10;
         $faker = $this->getFaker();



         for ($i = 0; $i < $loop; ++$i) {
              $user = $this->getRandomUser();
             $name = $faker->sentence();
             $description = $faker->paragraph($nbSentences = $faker->randomDigitNotNull);
             $longitude = $faker->longitude;
             $latitude = $faker->latitude;
             $coordinates = $longitude.','.$latitude;

             $arr = [
            'name' => $name,
            'description' => $description,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'coordinates' => $coordinates,
            'created_by' => $user,
            'updated_by' => $user
          ];

             \App\Point::create($arr);

         }
     }
}
