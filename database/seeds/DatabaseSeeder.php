<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \DB;

class DatabaseSeeder extends Seeder
{
  protected $faker;

  public function getFaker()
{


    if (empty($this->faker))
    {
        $faker = Faker\Factory::create();
        //$faker->addProvider(new Faker\Provider\Base($faker));
        //$faker->addProvider(new Faker\Provider\Lorem($faker));
    }

    return $this->faker = $faker;
 }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Eloquent::unguard();
            $this->call("UserTableSeeder");
            $this->call("PointsTableSeeder");
            $this->call("TagTableSeeder");
            $this->call("PointTagsTableSeeder");
            Model::reguard();
    }


}
