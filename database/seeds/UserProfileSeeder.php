<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_profiles')->insert([
            'user_id' => 1,
            'fio' => 'Захаров Михаил',
            'phone' => '+7 (904) 766-69-94',
            'status' => 'По всем вопросам - в личку! 👌',
            'email' => 'cashalotkzn@gmail.com',
            'position' => 'Основатель Deesk',
            'telegram' => 'uffome',
            'instagram' => 'deevanych',
            'vk' => 'id536532858',
            'facebook' => 'cashalotkzn',
        ]);
    }
}
