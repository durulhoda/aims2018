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
		$menuid=$rh->getMenuId('group');
		$hasMenu=$rh->hasMenu($menuid);
		if($hasMenu==false){
			return redirect('error');
		}
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
		$result=\DB::table('groups')
		->join('programlevels','groups.programLevelid','=','programlevels.id')->select('groups.*','programlevels.name as levelName')->get();
		return view('settings.group.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
	}
	public function create(){
		$rh=new RoleHelper();
        $menuid=$rh->getMenuId('group');
        $hasMenu=$rh->hasMenu($menuid);
		if($hasMenu==false){
			return redirect('error');
		}
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
		if($permission[2]==1){
			$levels=ProgramLevel::all();
			return view('settings.group.create',['sidebarMenu'=>$sidebarMenu,'levels'=>$levels]);
		}else{
			return redirect('group');
		}
		
	}
	public function store(Request $request){
		$aGroup=new Group();
		$aGroup->name=$request->name;
		$aGroup->programLevelid=$request->programLevelid;
		$aGroup->save();
		return redirect('group');
	}
	public function edit($id)
	{	
		$rh=new RoleHelper();
        $menuid=$rh->getMenuId('group');
        $hasMenu=$rh->hasMenu($menuid);
		if($hasMenu==false){
			return redirect('error');
		}
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
		if($permission[4]==1){
			$levels=ProgramLevel::all();
			$aGroup=Group::findOrfail($id);
			return view('settings.group.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aGroup,'levels'=>$levels]);
		}else{
			return redirect('group');
		}
		
	}
	 public function update(Request $request, $id)
    {
    	$aGroup=Group::findOrfail($id);
    	$aGroup->name=$request->name;
    	$aGroup->programLevelid=$request->programLevelid;
		$aGroup->update();
		return redirect('group');
    }
}
