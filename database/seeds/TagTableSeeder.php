<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {

       $numberOfTags = 15;
       $faker = $this->getFaker();


       for ($i = 0; $i < $numberOfTags; $i++)
       {
           $name = $faker->word;
           $user = $this->getRandomUser();

           $data = [
             'tag' => $name,
             'created_by' => $user
           ];
           var_dump($data);
           \App\Tags::create($data);
           //var_dump($data);
       }
     }
}
