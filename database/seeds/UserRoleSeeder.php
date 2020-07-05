<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 3,
            'role_id' => 1,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 4,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 4,
            'user_id' => 3,
        ]);
    }
}
