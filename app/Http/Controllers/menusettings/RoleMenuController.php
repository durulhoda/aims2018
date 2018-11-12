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
			return view("menusettings.rolemenu.create",['dmenu'=>$dmenu,'roles'=>$roles,'menus'=>$menus]);
		}else{
			return redirect('rolemenu');
		}

	}
	public function store(Request $request){
		$aBean=new RoleMenu();
		$aBean->role_id=$request->role_id;
		$aBean->menu_id=$request->menu_id;
		$aBean->save();
		return redirect('rolemenu');
	}
	public function edit($id){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[4]==1){
			$dmenu=Role::getMenu();
			$result=\DB::select('SELECT role_menu.id,role_menu.role_id,role_menu.menu_id,roles.name as roleName,menus.name as menuName FROM `role_menu`
INNER JOIN roles on role_menu.role_id=roles.id
INNER JOIN menus on role_menu.menu_id=menus.id where role_menu.id=?',[$id]);
			$roles=Role::all();
			$menus=Menu::all();
			$aBean=$result[0];
			return view("menusettings.rolemenu.edit",['dmenu'=>$dmenu,'bean'=>$aBean,'roles'=>$roles,'menus'=>$menus]);
		}else{
			return redirect('rolemenu');
		}
	}
	public function update(Request $request, $id){
		$aBean=RoleMenu::findOrfail($id);
		$aBean->role_id=$request->role_id;
		$aBean->menu_id=$request->menu_id;
		$aBean->update();
		return redirect('rolemenu');
	}
}
