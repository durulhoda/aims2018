<?php

namespace App\Http\Controllers\settings;
use App\role\RoleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\settings\ProgramLevel;
use App\settings\Group;
use App\settings\Program;
class ProgramController extends Controller
{
	public function __construct()
{
    $this->middleware('auth');
}
	public function index()
	{
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('program');
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
		$result=\DB::table('programs')
		->join('groups','programs.groupid','=','groups.id')
		->join('programlevels','groups.programLevelid','=','programlevels.id')
		->select('programs.*', 'programlevels.name as lavelName','groups.name as groupName')
		->get();
		return view('settings.program.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
	}
	public function create()
	{
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('program');
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
			$levels=ProgramLevel::all();
			return view('settings.program.create',compact('sidebarMenu','levels'));
		}else{
			return redirect('program');
		}
		
	}
	public function store(Request $request)
	{ 
		$aBean=new Program();
		$aBean->name=$request->name;
		$aBean->groupid=$request->groupid;
		$aBean->save();
		return redirect('program');
	}
	public function edit($id)
    {
    	$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('program');
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
    		 $levels=ProgramLevel::all();
	    	 $aBean=\DB::table('programs')
	    	 ->join('programlevels','programs.groupid','=','programlevels.id')
	    	 ->select('programs.*','programlevels.id as programLevelid')
	    	 ->where('programs.id',$id)
	    	 ->first();
	    	 $groups=\DB::table('groups')
	    	 ->select('groups.*')
	    	 ->where('groups.programLevelid',$aBean->programLevelid)
	    	 ->get();
	         return view('settings.program.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'levels'=>$levels,'groups'=>$groups]);
    	}else{
    		return redirect('program');
    	}
    	
    }
    public function update(Request $request, $id)
    {
    	$aBean=Program::findOrfail($id);
    	$aBean->name=$request->name;
		$aBean->groupid=$request->groupid;
		$aBean->update();
		return redirect('program');
    }
}
