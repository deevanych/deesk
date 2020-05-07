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
            'description' => 'По контракту #117',
            'organization_id' => 1,
        ]);
    }
}
