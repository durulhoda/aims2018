<?php

namespace App\Http\Controllers;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct(){
      $this->middleware('auth');
  }
	public function index(){
		$sidebarMenu=Role::getMenu();
		$accessStatus=Role::getAccessStatus();
		$result=User::all();
		return view('roleconfig.user.index',['sidebarMenu'=>$sidebarMenu,'accessStatus'=>$accessStatus,'result'=>$result]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			$sidebarMenu=Role::getMenu();
			$roles=Role::all();
			return view('roleconfig.user.create',['sidebarMenu'=>$sidebarMenu,'accessStatus'=>$accessStatus,'roles'=>$roles]);
		}else{
			return redirect('user');
		}
	}
	public function store(Request $request){
		$name = $request->name;
		$email = $request->email;
		$password=$request->password;
		$password=bcrypt($password);
		$role_id=$request->role_id;
		\DB::transaction(function() use ($name,$email,$password,$role_id) {
			$username=$name;
			$newUserId=\DB::table('users')->insertGetId(['name'=>$name,'email'=>$email,'password'=>$password]);
			$user_id=$newUserId;
			\DB::table('user_role')->insert(['user_id'=>$user_id,'role_id'=>$role_id]);
		});
		return redirect('user');
	}
	public function edit($id){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[4]==1){
			$sidebarMenu=Role::getMenu();
			$aBean=User::findOrfail($id);
			$roles=Role::all();
			return view('roleconfig.user.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'roles'=>$roles]);
		}else{
			return redirect('user');
		}
	}
	public function update(Request $request, $id){

	}

}
