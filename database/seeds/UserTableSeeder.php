<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends DatabaseSeeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $loop = 100;
      $faker = $this->getFaker();

      // create admin User
      \App\User::create([
          "name" => 'admin',
          "email" => 'arelstone@gmail.com',
          $password = Hash::make("password"),
          $remember_token = md5(uniqid(mt_rand(), true)),
      ]);

      for ($i = 0; $i < $loop-1; $i++)
      {
          $name = $faker->userName;
          $email = $faker->email;
          $password = Hash::make("password");
          $remember_token = md5(uniqid(mt_rand(), true));

          \App\User::create([
            "name" => $name,
              "email" => $email,
              "password" => $password,
              "remember_token" => $remember_token,
          ]);
      }
    }
}
