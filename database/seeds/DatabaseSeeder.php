<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    protected $faker;

    public function getFaker()
    {
        if (empty($this->faker)) {
            $faker = Faker\Factory::create();
        }

        return $this->faker = $faker;
    }


    /**
     * Run the database seeds.
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call('UserTableSeeder');
        $this->call('PointsTableSeeder');
        $this->call('TagTableSeeder');
        $this->call('PointTagsTableSeeder');
        Model::reguard();
    }

    public function random_tag()
    {
      $tags = \App\Tags::all();
      $random_key = array_rand($tags->toArray(), 1);
        //dd($this->tags[$random_key]->name);
      return $tags[$random_key]->id;
    }

    public function random_point()
    {
      $points = \App\Point::all();
      $random_key = array_rand($points->toArray(), 1);
      if ($random_key == 0){
          $random_key = 1;
      }

      //dd($this->points[$random_key]->name);
      return $points[$random_key]->id;
    }


    public function getRandomUser()
    {
        $users = \App\User::all();
        return array_rand($users->toArray(), 1);
    }
}
