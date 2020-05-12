<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OrganizationSeeder::class,
            UserSeeder::class,
            IssueStatusColorSeeder::class,
            IssueStatusIconSeeder::class,
            IssueStatusSeeder::class,
            RegistrationTypeSeeder::class,
            IssuePrioritySeeder::class,
            IssueTypeSeeder::class,
            IssueSeeder::class,
            IssueCommentSeeder::class,
            OauthClientSeeder::class,l
        ]);
    }
}
