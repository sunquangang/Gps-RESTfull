<?php

use App\User;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        //

        $adminRoleCreated = DB::table('roles')->insert(
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'This is the adminstrator role!',
                'created_at' => Date('yyyy-MM-dd h:i:s'),
                'updated_at' => Date('yyyy-MM-dd h:i:s')
            ]);
        if ($adminRoleCreated) {
            $adminRole = DB::table('roles')->limit(1)->first();
            $firstUser = User::limit(1)->first();

            $data = [
                'user_id' => $firstUser->id,
                'role_id' => $adminRole->id
            ];

            Role::create($data);
        }
    }
}
