<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\settings\Program;
use App\settings\Group;
use App\institutesettings\Institute;
use App\institutesettings\VProgramGroup;
use App\role\RoleHelper;

class VProgramGroupController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('vprogramgroup');
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
			$vprogramGroupList=\DB::table('vprogramgroup')
			->join('programs', 'vprogramgroup.programid', '=', 'programs.id')
			->join('institute', 'programs.instituteid', '=', 'institute.id')
			->join('groups', 'vprogramgroup.groupid', '=', 'groups.id')
			->select('vprogramgroup.id','institute.name AS instituteName','programs.name AS programName','groups.name AS groupName')
			->orderByRaw('id')
			->get();
		}else{
			$instituteId=$rh->getInstituteId($rh->getRoleId());
			$vprogramGroupList=\DB::table('vprogramgroup')
			->join('programs', 'vprogramgroup.programid', '=', 'programs.id')
			->join('groups', 'vprogramgroup.groupid', '=', 'groups.id')
			->join('institute', 'programs.instituteid', '=', 'institute.id')
			->select('vprogramgroup.id','institute.name AS instituteName','programs.name AS programName','groups.name AS groupName')
			->orderByRaw('id')
			->where('programs.instituteid',$instituteId)
			->get();
		}
		return view('institutesettings.vprogramgroup.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'vprogramGroupList'=>$vprogramGroupList]);
	}
	public function create(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('vprogramgroup');
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
				$programList=array();
				$groupList=array();
				return view('institutesettings.vprogramgroup.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList,'instituteList'=>$instituteList,'roleid'=>$rh->getRoleId()]);
			}else{
				$instituteId=$rh->getInstituteId($rh->getRoleId());
				$aInstitute=$rh->getInstitute();
				$programList=\DB::table('programs')
				->select('id','name')
				->where('programs.instituteid',$instituteId)
				->get();
				$groupList=\DB::table('groups')
				->select('id','name')
				->where('groups.instituteid',$instituteId)
				->get();
				return view('institutesettings.vprogramgroup.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList,'aInstitute'=>$aInstitute,'roleid'=>$rh->getRoleId()]);
			}
		}else{
			return redirect('vprogramgroup');
		}
	}
	public function store(Request $request){
		$aVProgramGroup=new VProgramGroup();
		$aVProgramGroup->programid=$request->programid;
		$aVProgramGroup->groupid=$request->groupid;
		$hasItem=\DB::table('vprogramgroup')
		->select('vprogramgroup.*')
		->where('programid',$aVProgramGroup->programid)
		->where('groupid',$aVProgramGroup->groupid)
		->exists();
		if(!$hasItem){
			$aVProgramGroup->save();
		}else{
        // This item already assign
		}
		return redirect('vprogramgroup');
	}
	public function edit($id){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('vprogramgroup');
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
			$aInstitute=$rh->getInstitute();
			$programList=\DB::select("SELECT * FROM `programs` WHERE `instituteid`=?",[$aInstitute->id]);
			$groupList=\DB::select("SELECT * FROM `groups` WHERE `instituteid`=?",[$aInstitute->id]);
			$aVProgramGroup=\DB::select("SELECT vprogramgroup.*,programs.instituteid FROM `vprogramgroup` 
INNER JOIN programs ON vprogramgroup.programid=programs.id
INNER JOIN groups ON vprogramgroup.groupid=groups.id
WHERE vprogramgroup.id=?",[$id])[0];
			if($rh->getRoleId()==1){
				$instituteList=\DB::table('institute')
				->select('id','name')
				->get();
				return view('institutesettings.vprogramgroup.edit',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList,'instituteList'=>$instituteList,'bean'=>$aVProgramGroup,'roleid'=>$rh->getRoleId()]);
			}else{
				return view('institutesettings.vprogramgroup.edit',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList,'aInstitute'=>$aInstitute,'bean'=>$aVProgramGroup,'roleid'=>$rh->getRoleId()]);
			}
		}else{
			return redirect('vprogramgroup');
		}
	}
	public function update(Request $request, $id){
		$aVProgramGroup=VProgramGroup::findOrfail($id);
		$aVProgramGroup->programid=$request->programid;
		$aVProgramGroup->groupid=$request->groupid;
		$hasItem=\DB::table('vprogramgroup')
		->select('vprogramgroup.*')
		->where('programid',$aVProgramGroup->programid)
		->where('groupid',$aVProgramGroup->groupid)
		->exists();
		if(!$hasItem){
			$aVProgramGroup->update();
		}else{
        // This item already assign
		}
		return redirect('vprogramgroup');
	}
}
