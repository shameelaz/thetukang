<?php

namespace Overdrive\Web\Database\Seeder;

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
                'nama_bm' => 'Pengurusan Sistem',
                'nama_en' => 'System Management',
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
                'nama_bm' => 'Pengurusan Menu',
                'nama_en' => 'Menu Management',
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
                'nama_bm' => 'Pengurusan Pengguna',
                'nama_en' => 'User Management',
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
                'nama_bm' => 'Pengurusan Hak',
                'nama_en' => 'Permission Settings',
                'type' => '1',
                'parent_id' => '4',
                'route' => 'user/permissions',
                'permission' => '["*"]',
                'order' => '2',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_bm' => 'Tetapan Pengguna',
                'nama_en' => 'User Settings',
                'type' => '1',
                'parent_id' => '4',
                'route' => 'user/index',
                'permission' => '["*"]',
                'order' => '1',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_bm' => 'Pengurusan Peranan',
                'nama_en' => 'Role Setting',
                'type' => '1',
                'parent_id' => '4',
                'route' => 'user/role',
                'permission' => '["*"]',
                'order' => '3',
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

           ]);
    }
}
