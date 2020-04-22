<?php

use Illuminate\Database\Seeder;

class IssueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('issue_types')->insert([
            'title' => 'Обслуживание',
            'organization_id' => 1
        ]);
    }
}
