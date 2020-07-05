<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'name' => 'Управляющий сервисной компании',
            'slug' => 'service.admin',
            'description' => 'Полный пакет прав на сервисную компанию'
        ]);
        DB::table('roles')->insert([
            'name' => 'Сотрудник сервисной компании',
            'slug' => 'service.employee',
            'description' => 'Права на работу с заявками'
        ]);
        DB::table('roles')->insert([
            'name' => 'Управляющий клиентской компании',
            'slug' => 'client.admin',
            'description' => 'Полный пакет прав на клиентскую компанию'
        ]);
        DB::table('roles')->insert([
            'name' => 'Сотрудник клиентской компании',
            'slug' => 'client.employee',
            'description' => 'Права на работу с заявками'
        ]);
    }
}
