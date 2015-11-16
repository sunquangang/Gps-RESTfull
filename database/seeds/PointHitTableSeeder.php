<?php

use Illuminate\Database\Seeder;


class PointHitTableSeeder extends Seeder
{

	protected $records = 100;


    public function run()
    {
        for ($x=0; $x < $this->records; $x++) {
            $arr = [
              'point_id' => $this->random_point(),
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
      return $points[$random_key]->id;
    }

}
