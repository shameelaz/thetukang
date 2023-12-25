<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class Menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // DB::table('acl_roles')->truncate();
        DB::table('menu')->insert([
            [
                'name_bm' => 'Pengurusan Sistem',
                'name_en' => 'System Management',
                'type' => '2',
                'parent_id' => null,
                'route' => null,
                'permission' => '["*"]',
                'order' => '1',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             [
                'name_bm' => 'Pengurusan Menu',
                'name_en' => 'Menu Management',
                'type' => '1',
                'parent_id' => '1',
                'route' => 'menu/index',
                'permission' => '["*"]',
                'order' => '1',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             [
                'name_bm' => 'Pengurusan Pengguna',
                'name_en' => 'User Management',
                'type' => '1',
                'parent_id' => '1',
                'route' => 'user/index',
                'permission' => '["*"]',
                'order' => '2',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             [
                'name_bm' => 'Pengurusan Hak',
                'name_en' => 'Permission Settings',
                'type' => '1',
                'parent_id' => '3',
                'route' => 'user/permissions',
                'permission' => '["*"]',
                'order' => '2',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name_bm' => 'Tetapan Pengguna',
                'name_en' => 'User Settings',
                'type' => '1',
                'parent_id' => '3',
                'route' => 'user/index',
                'permission' => '["*"]',
                'order' => '1',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name_bm' => 'Pengurusan Peranan',
                'name_en' => 'Role Setting',
                'type' => '1',
                'parent_id' => '3',
                'route' => 'user/roles',
                'permission' => '["*"]',
                'order' => '3',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

           ]);
    }
}
