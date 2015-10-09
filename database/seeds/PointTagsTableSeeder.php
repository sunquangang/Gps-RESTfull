<?php

use Illuminate\Database\Seeder;
class PointTagsTableSeeder extends DatabaseSeeder
{

  protected $minTags = 1;
  protected $maxTags = 5;
  protected $records = 15;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x=0; $x < $this->records; $x++) {
          //var_dump('NUMBER of Tags to create: ' . $this->random_number()) . '\n\n';

          for ($i=0; $i < $this->random_number(); $i++) {
            #echo 'i: ' . $i. ' ==';
            $arr = [
              'point_id' => $this->random_point(),
              'tags_id' => $this->random_tag(),
              'created_by' => $this->getRandomUser(),
            ];
            //dd($arr);
            /*var_dump('loop nr: ' . $i) . '\n';
            var_dump($arr);*/
            \App\PointTag::create($arr);
          }
        }
    }



    private function random_number ()
    {
        return rand($this->minTags, $this->maxTags);
    }
}
