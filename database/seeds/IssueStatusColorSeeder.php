<?php

use Illuminate\Database\Seeder;

class IssueStatusColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('issue_status_colors')->insert([
            'title' => 'blue',
            'description' => 'Голубая лагуна',
        ]);
        DB::table('issue_status_colors')->insert([
            'title' => 'green',
            'description' => 'Сонный изумруд',
        ]);
        DB::table('issue_status_colors')->insert([
            'title' => 'orange',
            'description' => 'Молодое солнце',
        ]);
        DB::table('issue_status_colors')->insert([
            'title' => 'red',
            'description' => 'Ночное утро',
        ]);
        DB::table('issue_status_colors')->insert([
            'title' => 'black',
            'description' => 'Космический любимый',
        ]);
    }
}
