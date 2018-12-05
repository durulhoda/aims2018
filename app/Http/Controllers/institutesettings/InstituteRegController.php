<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
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
        $passw=$request->password;
        $password=bcrypt($passw);
        \DB::transaction(function() use ($name,$username,$email,$password) {
            $rh=new RoleHelper();
            $newUserId=\DB::table('users')->insertGetId(['name'=>$username,'email'=>$email,'password'=>$password]);
            $newInstituteId=\DB::table('institute')->insertGetId(['name'=>$name,'userid'=>$newUserId]);
            // dd($newInstituteId);
            $rolecreatorid=\DB::table('roles')->where('rolecreatorid',0)->first()->id;
            $newRoleId=\DB::table('roles')->insertGetId(['name'=>$name,'rolecreatorid'=>$rolecreatorid,'instituteid'=>$newInstituteId]);
            \DB::table('user_role')->insertGetId(['userid'=>$newUserId,'roleid'=>$newRoleId]);
            //Default Menu List For School Role
            $urlList=['role','menu'];
            $list=$rh->setDefaultMenus($urlList);
            foreach ($list as $item) {
                if($item->parentid!=0){
                    $pv=7;
                }else{
                    $pv=0;
                }
                \DB::table('role_menu')->insert(['roleid'=>$newRoleId,'menuid'=>$item->id,'permissionvalue'=>$pv]);
            }
        });
        return redirect('/');
    }
    public function edit($id){

    }
    public function update(Request $request, $id){
    	
    }
}
