<?php


class UserTableSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $loop = 5;
        $faker = $this->getFaker();

        $admin = [
            'name' => 'admin',
            'email' => 'arelstone@gmail.com',
            'password' => Hash::make('password'),
            'remember_token' => md5(uniqid(mt_rand(), true)),
        ];
//        dd($admin);
      // create admin User
      \App\User::create($admin);

        for ($i = 0; $i < $loop - 1; ++$i) {
            $name = $faker->userName;
            $email = $faker->email;
            $data = [
              'name' => $name,
              'email' => $email,
              'password' => Hash::make('password'),
              'remember_token' => md5(uniqid(mt_rand(), true)),
            ];

            \App\User::create($data);
            print 'Done '.$loop.' entries was created';
        }
    }
}
