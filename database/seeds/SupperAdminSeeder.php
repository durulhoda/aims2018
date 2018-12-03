<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SupperAdminSeeder extends Seeder
{
    public function run()
    {
       	DB::table('users')->insert([
       		[
            'name' => 'Lima',
            'email' => 'lima@gmail.com',
            'password' => bcrypt('lima@gmail.com')
           ],
           [
            'name' => 'Supper Admin',
            'email' => 'supperadmin@gmail.com',
            'password' => bcrypt('supperadmin@gmail.com')
        	]
        ]);
        DB::table('roles')->insert([
            'name' => 'Supper Admin',
            'rolecreatorid' => '0',
            'instituteid' => '0',
        ]);

        DB::table('user_role')->insert([
        	[
            'userid' => '1',
            'roleid' => '1',
        	],
        	[
            'userid' => '2',
            'roleid' => '1',
        	]
        ]);
        DB::table('permissions')->insert([
            'name' => 'Read',
            'level' => '1',
        ]);
        DB::table('menus')->insert([
            'name' => 'Menus',
            'url' => 'menu',
            'parentid' => '0',
            'menuorder'=>'100'
        ]);
        DB::table('role_menu')->insert([
            'roleid' => '1',
            'menuid' => '1',
            'permissionvalue' => '1',
        ]);
    }
}
