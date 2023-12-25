<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=RoleSeeder
     *
     * @return void
     */
    public function run()
    {
        // DB::table('acl_roles')->delete();

        $roles = [
            // ['id'=>1, 'name'=>'Administrator','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i') ],
            ['id'=>2, 'name'=>'Pentadbir Sistem' ,'created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['id'=>3, 'name'=>'Pentadbir Kewangan' ,'created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
            ['id'=>4, 'name'=>'Pentadbir Agensi / PTJ','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i') ],
            ['id'=>5, 'name'=>'Pegawai Agensi / PTJ','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i') ],
            ['id'=>6, 'name'=>'Pengurusan Tertinggi','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i') ],
            ['id'=>7, 'name'=>'Pengguna Awam','created_at'=>date('Y-m-d H:s:i'),'updated_at'=>date('Y-m-d H:s:i')],
        ];

        DB::table('acl_roles')->insert($roles);

        
    }
}
