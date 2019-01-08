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
		$roleid=$rh->getRoleId();
		if($roleid==1){
			$result=\DB::table('groups')
			->join('institute', 'groups.instituteid', '=', 'institute.id')
			->select('groups.*','institute.name AS instituteName')
			->get();
		}else{
			$instituteId=$rh->getInstituteId($rh->getRoleId());
			$result=\DB::table('groups')
			->join('institute', 'groups.instituteid', '=', 'institute.id')
			->select('groups.*','institute.name AS instituteName')
			->where('instituteid',$instituteId)
			->get();
		}
		return view('settings.group.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission,'roleid'=>$roleid]);
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
			$roleid=$rh->getRoleId();
			if($roleid==1){
		        $instituteList=\DB::table('institute')
		        ->select('id','name')
		        ->get();
		        return view('settings.group.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$roleid,'instituteList'=>$instituteList]);
	      	}else{
		        $aInstitute=\DB::table('institute')
		        ->select('id','name')
		        ->where('userid',$rh->getUserId())
		        ->first();
		        return view('settings.group.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$roleid,'aInstitute'=>$aInstitute]);
	     	 }
		}else{
			return redirect('group');
		}
		
	}
	public function store(Request $request){
		$aGroup=new Group();
		$aGroup->name=$request->name;
		$aGroup->instituteid=$request->instituteid;
		$hasItem=\DB::table('groups')
	    ->select('groups.*')
	    ->where('instituteid',$aGroup->instituteid)
	    ->where('name',$aGroup->name)
	    ->exists();
	     if(!$hasItem){
       		$aGroup->save();
	    }else{
	        // This item already assign
	    }
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
		   	$roleid=$rh->getRoleId();
			if($roleid==1){
		        $instituteList=\DB::table('institute')
		        ->select('id','name')
		        ->get();
		        return view('settings.group.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aGroup,'roleid'=>$roleid,'instituteList'=>$instituteList]);
		      }else{
		        $aInstitute=\DB::table('institute')
		        ->select('id','name')
		        ->where('userid',$rh->getUserId())
		        ->first();
		        return view('settings.group.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aGroup,'roleid'=>$roleid,'aInstitute'=>$aInstitute]);
		      }
		}else{
			return redirect('group');
		}
		
	}
	public function update(Request $request, $id)
	{
		$aGroup=Group::findOrfail($id);
		$aGroup->name=$request->name;
		$aGroup->instituteid=$request->instituteid;
		$hasItem=\DB::table('groups')
	    ->select('groups.*')
	    ->where('instituteid',$aGroup->instituteid)
	    ->where('name',$aGroup->name)
	    ->exists();
	     if(!$hasItem){
       		$aGroup->update();
	    }else{
	        // This item already assign
	    }
		return redirect('group');
	}
}
