<?php


class PointsTableSeeder extends DatabaseSeeder
{

     /**
      * Run the database seeds.
      */
     public function run()
     {
         $loop = 100;
         $faker = $this->getFaker();

        $countries = [];
        for ($i = 0; $i < 5; ++$i) {
            array_push($countries, $faker->word);
        }


         for ($i = 0; $i < $loop; ++$i) {
            $user = $this->getRandomUser();
             $name = $faker->sentence();
             $description = $faker->paragraph($nbSentences = $faker->randomDigitNotNull);
             $longitude = $faker->longitude;
             $latitude = $faker->latitude;

             $arr = [
            'name' => $name,
            'description' => $description,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'country' => $countries[$faker->numberBetween(0,4)],
            'created_by' => $user,
            'updated_by' => $user
          ];

             \App\Point::create($arr);
         }
         
     }

}
