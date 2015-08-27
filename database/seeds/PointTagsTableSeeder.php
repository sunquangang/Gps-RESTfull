<?php

use Illuminate\Database\Seeder;

class PointTagsTableSeeder extends DatabaseSeeder
{

  protected $minTags = 1;
  protected $maxTags = 5;
  protected $tags;
  protected $points;
  protected $records = 15;


  public function __construct(){
    $this->points = \App\Point::all();
    $this->tags = \App\Tags::all();

    //dd($this->random_tag());


  }

  public function random_tag()
  {
    $random_key = array_rand($this->tags->toArray(), 1);
      //dd($this->tags[$random_key]->name);
    return $this->tags[$random_key]->id;
  }

  public function random_point()
  {
    $random_key = array_rand($this->points->toArray(), 1);
    //dd($this->points[$random_key]->name);
    return $this->points[$random_key]->id;
  }

  public function random_number ()
  {
      return rand($this->minTags, $this->maxTags);
  }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x=0; $x < $this->records; $x++) {
          print_r('// Record NUMBER: ' . $x);
          print_r('// RANDOM NUMBER: ' . $this->random_number());

          for ($i=0; $i < $this->random_number(); $i++) {
            echo 'i: ' . $i. ' ==';
            $arr = [
              'point_id' => $this->random_point(),
              'tag_id' => $this->random_tag(),
            ];
          //  var_dump($arr);
            \App\PointTag::create($arr);
          }
        }
    }
}
