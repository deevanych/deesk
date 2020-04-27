<?php

use Illuminate\Database\Seeder;

class IssueStatusIconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('issue_status_icons')->insert([
            'title' => 'dot'
        ]);
        DB::table('issue_status_icons')->insert([
            'title' => 'success'
        ]);
        DB::table('issue_status_icons')->insert([
            'title' => 'pause'
        ]);
        DB::table('issue_status_icons')->insert([
            'title' => 'closed'
        ]);
        DB::table('issue_status_icons')->insert([
            'title' => 'play'
        ]);
    }
}
