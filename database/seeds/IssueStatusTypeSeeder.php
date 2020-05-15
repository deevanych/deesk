<?php

use Illuminate\Database\Seeder;

class IssueStatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('issue_status_types')->insert([
            'title' => 'Нет',
            'description' => 'Обычная заявка',
        ]);
        DB::table('issue_status_types')->insert([
            'title' => 'Новая заявка',
            'description' => 'Выдается только что созданной заявке по умолчанию',
        ]);
        DB::table('issue_status_types')->insert([
            'title' => 'В архив',
            'description' => 'При назначении этого статуса заявка уйдет в архив',
        ]);
        DB::table('issue_status_types')->insert([
            'title' => 'Не учитывать время',
            'description' => 'Для заявки с таким статусом не будет учитываться время решения',
        ]);
        DB::table('issue_status_types')->insert([
            'title' => 'Решение',
            'description' => 'Статус отмечен как решение заявки',
        ]);
    }
}
