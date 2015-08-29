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
  }




    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x=0; $x < $this->records; $x++) {
          var_dump('NUMBER of Tags to create: ' . $this->random_number()) . '\n\n';

          for ($i=0; $i < $this->random_number(); $i++) {
            #echo 'i: ' . $i. ' ==';
            $arr = [
              'point_id' => $this->random_point(),
              'tags_id' => $this->random_tag(),
            ];
            var_dump('loop nr: ' . $i) . '\n';
            var_dump($arr);
            \App\PointTag::create($arr);
          }
        }
    }

    private function random_tag()
    {
      $random_key = array_rand($this->tags->toArray(), 1);
        //dd($this->tags[$random_key]->name);
      return $this->tags[$random_key]->id;
    }

    private function random_point()
    {
      $random_key = array_rand($this->points->toArray(), 1);
      //dd($this->points[$random_key]->name);
      return $this->points[$random_key]->id;
    }

    private function random_number ()
    {
        return rand($this->minTags, $this->maxTags);
    }
}
