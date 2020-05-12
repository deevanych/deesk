<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('oauth_clients')->insert([
            'name' => 'site',
            'secret' => 'M7AmP0MDEdnFq9rhyzuSfvvYOWlxAXbELJPqhCPB',
            'redirect' => 'http://localhost',
            'password_client' => 1,
            'personal_access_client' => 0,
            'revoked' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
