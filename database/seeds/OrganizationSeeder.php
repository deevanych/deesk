<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organizations')->insert([
            'title' => 'Сервис',
            'full_name' => 'Обслуживающая компания',
            'domain' => 'service',
        ]);
        DB::table('organizations')->insert([
            'title' => 'Клиент',
            'full_name' => 'Ресторан',
            'domain' => 'client',
            'parent_id' => 1,
        ]);
        DB::table('organizations')->insert([
            'title' => 'Второй клиент',
            'full_name' => 'Ресторан',
            'domain' => 'client2',
            'parent_id' => 1,
        ]);
    }
}
