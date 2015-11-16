<?php

use Illuminate\Database\Seeder;
use App\PointLike;

class PointLikeTableSeeder extends Seeder
{
    
	protected $records = 300;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x=0; $x < $this->records; $x++) {
            $arr = [
              'point_id' => $this->random_point(),
              'user_id' => $this->getRandomUser(),
            ];
            \App\PointLike::create($arr);
          }
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
        return \App\User::all()->random(1)->id;

    }
}
