<?php

use Illuminate\Database\Seeder;

class RegistrationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('registration_types')->insert([
            'title' => 'Сайт',
        ]);
        DB::table('registration_types')->insert([
            'title' => 'E-mail',
        ]);
        DB::table('registration_types')->insert([
            'title' => 'API',
        ]);
    }
}
