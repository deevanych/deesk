<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Сервис',
            'email' => 'service@test.com',
            'password' => Hash::make('123456'),
            'organization_id' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'Клиент',
            'email' => 'client@test.com',
            'password' => Hash::make('123456'),
            'organization_id' => 2,
        ]);
        DB::table('users')->insert([
            'name' => 'Клиент 2',
            'email' => 'client2@test.com',
            'password' => Hash::make('123456'),
            'organization_id' => 3,
        ]);
    }
}
