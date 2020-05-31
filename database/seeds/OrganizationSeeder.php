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
        ]);
        DB::table('organizations')->insert([
            'title' => 'Окинава',
            'full_name' => 'ИП Зиннуров Алмаз Минзахитович',
            'parent_id' => 1,
            'image' => 'okinava.jpg'
        ]);
        DB::table('organizations')->insert([
            'title' => 'Макдональдс',
            'full_name' => 'ООО «Макдоналдс»',
            'parent_id' => 1,
            'image' => 'mcdonalds.svg'
        ]);
    }
}
