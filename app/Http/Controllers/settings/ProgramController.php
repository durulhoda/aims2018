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
		if($rh->getRoleId()==1){
			$result=\DB::table('programs')
			->join('institute', 'programs.instituteid', '=', 'institute.id')
			->select('programs.id','institute.name AS instituteName','programs.name')
			->get();
		}else{
			$instituteId=$rh->getInstituteId($rh->getRoleId());
			$result=\DB::table('programs')
			->join('institute', 'programs.instituteid', '=', 'institute.id')
			->select('programs.id','institute.name AS instituteName','programs.name')
			->where('instituteid',$instituteId)
			->get();
		}
		return view('settings.program.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission,'roleid'=>$rh->getRoleId()]);
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
			if($rh->getRoleId()==1){
	        $instituteList=\DB::table('institute')
	        ->select('id','name')
	        ->get();
	        return view('settings.program.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList]);
	      	}else{
	        $aInstitute=\DB::table('institute')
	        ->select('id','name')
	        ->where('userid',$rh->getUserId())
	        ->first();
	        return view('settings.program.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute]);
	     	 }
		}else{
			return redirect('program');
		}
		
	}
	public function store(Request $request)
	{ 
		$aProgram=new Program();
		$aProgram->instituteid=$request->instituteid;
		$aProgram->name=$request->name;
		$hasItem=\DB::table('programs')
	    ->select('programs.*')
	    ->where('instituteid',$aProgram->instituteid)
	    ->where('name',$aProgram->name)
	    ->exists();
	     if(!$hasItem){
       		$aProgram->save();
	    }else{
	        // This item already assign
	    }
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
	    	 $aProgram=Program::findOrfail($id);
		   if($rh->getRoleId()==1){
		        $instituteList=\DB::table('institute')
		        ->select('id','name')
		        ->get();
		        return view('settings.program.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aProgram,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList]);
		      }else{
		        $aInstitute=\DB::table('institute')
		        ->select('id','name')
		        ->where('userid',$rh->getUserId())
		        ->first();
		        return view('settings.program.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aProgram,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute]);
		      }
    	}else{
    		return redirect('program');
    	}
    	
    }
    public function update(Request $request, $id)
    {
    	$aProgram=Program::findOrfail($id);
    	$aProgram->instituteid=$request->instituteid;
    	$aProgram->name=$request->name;
    	$hasItem=\DB::table('programs')
	    ->select('programs.*')
	    ->where('instituteid',$aProgram->instituteid)
	    ->where('name',$aProgram->name)
	    ->exists();
	     if(!$hasItem){
       		$aProgram->update();
	    }else{
	        // This item already assign
	    }
		return redirect('program');
    }
}
