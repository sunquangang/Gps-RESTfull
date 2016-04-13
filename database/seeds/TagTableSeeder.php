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

       $loop = 35;
       $faker = $this->getFaker();


       for ($i = 0; $i < $loop; $i++)
       {
           $name = $faker->word;
           $user = $this->getRandomUser();

           $data = [
             'tag' => $name,
             'created_by' => $user
           ];

           \App\Tags::create($data);
           print 'Done '.$loop.' entries was created';
       }
     }
}
