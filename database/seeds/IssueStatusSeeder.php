<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('issue_statuses')->insert([
            'title' => 'Новая',
            'organization_id' => 1,
            'color_id' => 1,
            'icon_id' => 1,
        ]);
        DB::table('issue_statuses')->insert([
            'title' => 'Решена',
            'organization_id' => 1,
            'color_id' => 2,
            'icon_id' => 2,
        ]);
        DB::table('issue_statuses')->insert([
            'title' => 'Закрыта',
            'organization_id' => 1,
            'color_id' => 1,
            'icon_id' => 1,
        ]);
        DB::table('issue_statuses')->insert([
            'title' => 'В работе',
            'organization_id' => 1,
            'color_id' => 1,
            'icon_id' => 1,
        ]);
        DB::table('issue_statuses')->insert([
            'title' => 'На паузе',
            'organization_id' => 1,
            'color_id' => 1,
            'icon_id' => 1,
        ]);
    }
}
