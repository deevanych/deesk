<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssuePrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('issue_priorities')->insert([
            'title' => 'Низкий',
            'organization_id' => 1
        ]);
    }
}
