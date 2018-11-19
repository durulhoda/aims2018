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
            'id' => '1',
            'name' => 'Supper Admin',
            'rolecreatorid' => '0',
            'instituteid' => '0',
            'accesspower' => '63',
        ]);
        DB::table('user_role')->insert([
        	[
            'user_id' => '1',
            'role_id' => '1',
        	],
        	[
            'user_id' => '2',
            'role_id' => '1',
        	]
        ]);
        DB::table('menus')->insert([
            'name' => 'Menus',
            'url' => 'menu',
            'parentid' => '0',
            'menuorder'=>'100'
        ]);
        DB::table('role_menu')->insert([
            'role_id' => '1',
            'menu_id' => '1',
        ]);
    }
}
