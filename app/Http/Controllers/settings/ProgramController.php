<?php

namespace App\Http\Controllers\settings;
use App\Role;
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
		if(Role::checkAdmin()==1){
        $sidebarMenu=Role::getAllMenu();
     }else{
        $sidebarMenu=Role::getMenu();
     }
		$accessStatus=Role::getAccessStatus();
		$result=\DB::table('programs')
		->join('groups','programs.groupid','=','groups.id')
		->join('programlevels','groups.programLevelid','=','programlevels.id')
		->select('programs.*', 'programlevels.name as lavelName','groups.name as groupName')
		->get();
		return view('settings.program.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create()
	{
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			$levels=ProgramLevel::all();
			return view('settings.program.create',compact('levels'));
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
    	$accessStatus=Role::getAccessStatus();
    	if($accessStatus[4]==1){
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
	         return view('settings.program.edit',['bean'=>$aBean,'levels'=>$levels,'groups'=>$groups]);
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
