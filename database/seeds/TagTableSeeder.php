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


       $faker = $this->getFaker();

       for ($i = 0; $i < 5; $i++)
       {
           $name = $faker->word;

           \App\Tags::create([
             "name" => $name
           ]);
       }
     }
}
