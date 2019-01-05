<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\settings\Program;
use App\settings\Group;
use App\settings\Session;
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
			$vprogramGroupList=\DB::table('vprogram_group')
			->join('institute', 'vprogram_group.instituteid', '=', 'institute.id')
			->join('sessions', 'vprogram_group.sessionid', '=', 'sessions.id')
			->join('programs', 'vprogram_group.programid', '=', 'programs.id')
			->join('groups', 'vprogram_group.groupid', '=', 'groups.id')
			->select('vprogram_group.id','institute.name AS instituteName','sessions.name AS sessionName','programs.name AS programName','groups.name AS groupName')
			->orderByRaw('id')
			->get();
		}else{
			$instituteId=$rh->getInstituteId($rh->getRoleId());
			$vprogramGroupList=\DB::table('vprogram_group')
			->join('institute', 'vprogram_group.instituteid', '=', 'institute.id')
			->join('sessions', 'vprogram_group.sessionid', '=', 'sessions.id')
			->join('programs', 'vprogram_group.programid', '=', 'programs.id')
			->join('groups', 'vprogram_group.groupid', '=', 'groups.id')
			->select('vprogram_group.id','institute.name AS instituteName','sessions.name AS sessionName','programs.name AS programName','groups.name AS groupName')
			->orderByRaw('id')
			->where('instituteid',$instituteId)
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
			$programList=Program::all();
			$groupList=Group::all();
			$sessionList=Session::all();
			if($rh->getRoleId()==1){
				$instituteList=\DB::table('institute')
				->select('id','name')
				->get();
				return view('institutesettings.vprogramgroup.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList,'sessionList'=>$sessionList,'instituteList'=>$instituteList,'roleid'=>$rh->getRoleId()]);
			}else{
				$aInstitute=\DB::table('institute')
				->select('id','name')
				->where('userid',$rh->getUserId())
				->first();
				return view('institutesettings.vprogramgroup.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList,'sessionList'=>$sessionList,'aInstitute'=>$aInstitute,'roleid'=>$rh->getRoleId()]);
			}
		}else{
			return redirect('vprogramgroup');
		}
	}
	public function store(Request $request){
		$aVProgramGroup=new VProgramGroup();
		$aVProgramGroup->instituteid=$request->instituteid;
		$aVProgramGroup->sessionid=$request->sessionid;
		$aVProgramGroup->programid=$request->programid;
		$aVProgramGroup->groupid=$request->groupid;
		$hasItem=\DB::table('vprogram_group')
		->select('vprogram_group.*')
		->where('instituteid',$aVProgramGroup->instituteid)
		->where('sessionid', $aVProgramGroup->sessionid)
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
			$programList=Program::all();
			$groupList=Group::all();
			$sessionList=Session::all();
			$aVProgramGroup=VProgramGroup::findOrfail($id);
			if($rh->getRoleId()==1){
				$instituteList=\DB::table('institute')
				->select('id','name')
				->get();
           // dd($instituteList);
				return view('institutesettings.vprogramgroup.edit',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList,'sessionList'=>$sessionList,'instituteList'=>$instituteList,'bean'=>$aVProgramGroup,'roleid'=>$rh->getRoleId()]);
			}else{
				$aInstitute=\DB::table('institute')
				->select('id','name')
				->where('userid',$rh->getUserId())
				->first();
				return view('institutesettings.vprogramgroup.edit',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList,'sessionList'=>$sessionList,'aInstitute'=>$aInstitute,'bean'=>$aVProgramGroup,'roleid'=>$rh->getRoleId()]);
			}
		}else{
			return redirect('vprogramgroup');
		}
	}
	public function update(Request $request, $id){
		$aVProgramGroup=VProgramGroup::findOrfail($id);
		$aVProgramGroup->instituteid=$request->instituteid;
		$aVProgramGroup->sessionid=$request->sessionid;
		$aVProgramGroup->programid=$request->programid;
		$aVProgramGroup->groupid=$request->groupid;
		$hasItem=\DB::table('vprogram_group')
		->select('vprogram_group.*')
		->where('instituteid',$aVProgramGroup->instituteid)
		->where('sessionid', $aVProgramGroup->sessionid)
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
