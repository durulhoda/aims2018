<?php

namespace App\Http\Controllers\menusettings;
use App\Role;
use App\menusettings\RoleMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\menusettings\Menu;
use Auth;
class RoleMenuController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}
	public function index(){
		$dmenu=Role::getMenu();
		$accessStatus=Role::getAccessStatus();
		$result=\DB::select('SELECT role_menu.id,role_menu.role_id,role_menu.menu_id,roles.name as roleName,menus.name as menuName FROM `role_menu`
INNER JOIN roles on role_menu.role_id=roles.id
INNER JOIN menus on role_menu.menu_id=menus.id');
		return view("menusettings.rolemenu.index",['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			$dmenu=Role::getMenu();
			$roles=Role::all();
			$menus=Menu::all();
			return view("menusettings.rolemenu.create1",['dmenu'=>$dmenu,'roles'=>$roles,'menus'=>$menus]);
		}else{
			return redirect('rolemenu');
		}

	}
	public function store(Request $request){
		$selectmenu=$request->menu_id;
	    foreach ($selectmenu as $item) {
	    	$aBean=new RoleMenu();
	    	$aBean->role_id=$request->role_id;
	    	$aBean->menu_id=$item;
	    	$aBean->save();
	    }
		return redirect('rolemenu');
	}
	public function edit($id){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[4]==1){
			$dmenu=Role::getMenu();
			$roles=Role::all();
			$menus=Menu::all();//For Side Bar section
			$userid = Auth::user()->id;
			$result=\DB::select('SELECT menus.id,
menus.name AS menuName,
IFNULL(vrole_menu.menu_id,0) AS menu_id,
vrole_menu.user_id,
vrole_menu.role_id
FROM menus
LEFT JOIN (SELECT users.id,users.name as userName,user_role.user_id,user_role.role_id,roles.name as roleName,role_menu.menu_id  FROM users
INNER JOIN user_role ON users.id=user_role.user_id
INNER JOIN roles ON user_role.role_id=roles.id
INNER JOIN role_menu ON roles.id=role_menu.role_id
WHERE users.id=?) as vrole_menu on menus.id=vrole_menu.menu_id ORDER BY `menus`.`id` ASC',[$userid]);
			$aBean=$result[0];
			return view("menusettings.rolemenu.edit1",['dmenu'=>$dmenu,'bean'=>$aBean,'roles'=>$roles,'menus'=>$menus,'result'=>$result]);
		}else{
			return redirect('rolemenu');
		}
	}
	public function update(Request $request, $id){
		$selectmenu=$request->menu_id;
	    foreach ($selectmenu as $item) {
	    	$aBean=new RoleMenu();
	    	$aBean->role_id=$request->role_id;
	    	$aBean->menu_id=$item;
	    	$query="SELECT * FROM role_menu WHERE role_id=? AND menu_id=?";
	    	$result=\DB::select($query,[$aBean->role_id,$aBean->menu_id]);
	    	if(count($result)>0){
	    	   // $result
         //       $aBean->update();
	    	}else{
	    	  $aBean->save();
	    	}
	    	// dd(count($result));
	    	// $aBean->update();
	    }
		return redirect('rolemenu');
	}
}
