<?php

namespace App\Http\Controllers\settings;
use App\role\RoleHelper;
use App\Http\Controllers\Controller;
use App\settings\ProgramLevel;
use Illuminate\Http\Request;
use App\settings\Group;
use App\Http\Controllers\Redirect;
class GroupController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('group');
		if($aMenu==null){
			return redirect('error');
		}
		$menuid=$aMenu->id;
		$hasMenu=$rh->hasMenu($menuid);
		if($hasMenu==false){
			return redirect('error');
		}
		$sidebarMenu=$rh->getMenu();
		$permission=$rh->getPermission($menuid);
		$result=\DB::table('groups')
		->select('groups.*')
		->get();
		return view('settings.group.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
	}
	public function create(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('group');
		if($aMenu==null){
			return redirect('error');
		}
		$menuid=$aMenu->id;
		$hasMenu=$rh->hasMenu($menuid);
		if($hasMenu==false){
			return redirect('error');
		}
		$sidebarMenu=$rh->getMenu();
		$permission=$rh->getPermission($menuid);
		if($permission[2]==1){
			return view('settings.group.create',['sidebarMenu'=>$sidebarMenu]);
		}else{
			return redirect('group');
		}
		
	}
	public function store(Request $request){
		$aGroup=new Group();
		$aGroup->name=$request->name;
		$aGroup->save();
		return redirect('group');
	}
	public function edit($id)
	{	
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('group');
		if($aMenu==null){
			return redirect('error');
		}
		$menuid=$aMenu->id;
		$hasMenu=$rh->hasMenu($menuid);
		if($hasMenu==false){
			return redirect('error');
		}
		$sidebarMenu=$rh->getMenu();
		$permission=$rh->getPermission($menuid);
		if($permission[4]==1){
			$aGroup=Group::findOrfail($id);
			return view('settings.group.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aGroup]);
		}else{
			return redirect('group');
		}
		
	}
	public function update(Request $request, $id)
	{
		$aGroup=Group::findOrfail($id);
		$aGroup->name=$request->name;
		$aGroup->update();
		return redirect('group');
	}
}
