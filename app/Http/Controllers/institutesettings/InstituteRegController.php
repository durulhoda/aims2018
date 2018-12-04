<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteRegController extends Controller
{
   	public function index(){

    }
    public function create(){

    }
    public function store(Request $request){
        $name = $request->name;
        $username=$request->username;
        $email=$request->email;
        $pasw=$request->password;
        $password=bcrypt($pasw);
        \DB::transaction(function() use ($name,$username,$email,$password) {
            $newUserId=\DB::table('users')->insertGetId(['name'=>$username,'email'=>$email,'password'=>$password]);
            $newInstituteId=\DB::table('institute')->insertGetId(['name'=>$name,'userid'=>$newUserId]);
            $rolecreatorid=\DB::table('roles')->where('rolecreatorid',0)->first()->id;
            $newRoleId=\DB::table('roles')->insertGetId(['name'=>$name,'rolecreatorid'=>$rolecreatorid,'instituteid'=>$newInstituteId]);
            \DB::table('user_role')->insertGetId(['userid'=>$newUserId,'roleid'=>$newRoleId]);
            //Have to Work here
            
            \DB::table('role_menu')->insert(['roleid'=>$newRoleId,'menuid'=>3,'permissionvalue'=>7]);
            \DB::table('role_menu')->insert(['roleid'=>$newRoleId,'menuid'=>4,'permissionvalue'=>7]);
        });
        return redirect('/');
    }
    public function edit($id){

    }
    public function update(Request $request, $id){
    	
    }
}
