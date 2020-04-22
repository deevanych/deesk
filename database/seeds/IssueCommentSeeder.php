<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('issue_comments')->insert([
            'text' => 'Низкий',
            'issue_id' => 1,
            'author_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issue_comments')->insert([
            'text' => 'Хорошо, но пахнет плохо!',
            'issue_id' => 1,
            'author_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issue_comments')->insert([
            'text' => 'Хорошо, но пахнет плохо!',
            'issue_id' => 1,
            'author_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issue_comments')->insert([
            'text' => 'Хорошо, но пахнет плохо!',
            'issue_id' => 1,
            'author_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issue_comments')->insert([
            'text' => 'Хорошо, но пахнет плохо!',
            'issue_id' => 1,
            'author_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issue_comments')->insert([
            'text' => 'Хорошо, но пахнет плохо!',
            'issue_id' => 1,
            'author_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issue_comments')->insert([
            'text' => 'Хорошо, но пахнет плохо!',
            'issue_id' => 1,
            'author_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
