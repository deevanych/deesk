<?php

use Illuminate\Database\Seeder;

class OrganizationProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organization_profiles')->insert([
            'organization_id' => 2,
            'site' => 'https://okinavakazan.ru',
            'phone' => '8 (843) 233-44-33',
            'address' => 'г. Казань, ул. Университетская, 10',
        ]);
        DB::table('organization_profiles')->insert([
            'organization_id' => 3,
            'site' => 'https://mcdonalds.ru/',
            'phone' => '8 (495) 755-66-00',
            'address' => 'г. Москва, Газетный переулок, 17',
        ]);
    }
}
