<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->insert([
            'name' => 'client',
            'slug' => json_encode([
                'view' => true,
                'update' => true,
                'delete' => true,
                'create' => true
            ]),
            'description' => 'Просмотр клиентов',
        ]);
        DB::table('permissions')->insert([
            'name' => 'issue',
            'slug' => json_encode([
                'view' => true,
                'update' => true,
                'delete' => true,
                'create' => true
            ]),
            'description' => 'Просмотр клиентов',
        ]);
        DB::table('permissions')->insert([
            'name' => 'settings',
            'slug' => json_encode([
                'view' => true,
                'update' => true,
                'delete' => true,
                'create' => true
            ]),
            'description' => 'Просмотр клиентов',
        ]);
    }
}
