<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
use App\institutesettings\Institute;
use App\institutesettings\AdmissionProgram;
use App\settings\Session;
use App\settings\Program;
use App\settings\Group;
use App\settings\Medium;
use App\settings\Shift;
class AdmissionProgramController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('admissionprogram');
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
			$admissionprogramList=\DB::table('admissionprogram')
			->join('institute', 'admissionprogram.instituteid', '=', 'institute.id')
			->join('sessions', 'admissionprogram.sessionid', '=', 'sessions.id')
			->join('programs', 'admissionprogram.programid', '=', 'programs.id')
			->join('groups', 'admissionprogram.groupid', '=', 'groups.id')
			->join('mediums', 'admissionprogram.mediumid', '=', 'mediums.id')
			->join('shifts', 'admissionprogram.shiftid', '=', 'shifts.id')
			->select('admissionprogram.id','institute.name AS instituteName','sessions.name AS sessionName','programs.name AS programName','groups.name AS groupName','mediums.name AS mediumName','shifts.name AS shiftName')
			->orderByRaw('id')
			->get();
		}else{
			$instituteId=$rh->getInstituteId($rh->getRoleId());
			$admissionprogramList=\DB::table('admissionprogram')
			->join('institute', 'admissionprogram.instituteid', '=', 'institute.id')
			->join('sessions', 'admissionprogram.sessionid', '=', 'sessions.id')
			->join('programs', 'admissionprogram.programid', '=', 'programs.id')
			->join('groups', 'admissionprogram.groupid', '=', 'groups.id')
			->join('mediums', 'admissionprogram.mediumid', '=', 'mediums.id')
			->join('shifts', 'admissionprogram.shiftid', '=', 'shifts.id')
			->select('admissionprogram.id','institute.name AS instituteName','sessions.name AS sessionName','programs.name AS programName','groups.name AS groupName','mediums.name AS mediumName','shifts.name AS shiftName')
			->orderByRaw('id')
			->where('admissionprogram.instituteid',$instituteId)
			->get();
		}
		return view('institutesettings.admissionprogram.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$admissionprogramList,'roleid'=>$rh->getRoleId()]);
	}
	public function create(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('admissionprogram');
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
			$sessionList=Session::all();
			$programList=Program::all();
			$groupList=Group::all();
			$mediumList=Medium::all();
			$shiftList=Shift::all();
			if($rh->getRoleId()==1){
				$instituteList=\DB::table('institute')
				->select('id','name')
				->get();
				return view('institutesettings.admissionprogram.create',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList]);
			}else{
				$aInstitute=\DB::table('institute')
				->select('id','name')
				->where('userid',$rh->getUserId())
				->first();
				return view('institutesettings.admissionprogram.create',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList]);
			}
		}else{
			return redirect('admissionprogram');
		}
	}
	public function store(Request $request){
		$aAdmissionProgram=new AdmissionProgram();
		$aAdmissionProgram->instituteid=$request->instituteid;
		$aAdmissionProgram->sessionid=$request->sessionid;
		$aAdmissionProgram->programid=$request->programid;
		$aAdmissionProgram->groupid=$request->groupid;
		$aAdmissionProgram->mediumid=$request->mediumid;
		$aAdmissionProgram->shiftid=$request->shiftid;
		$hasItem=\DB::table('admissionprogram')
		->select('admissionprogram.*')
		->where('instituteid',$aAdmissionProgram->instituteid)
		->where('sessionid',$aAdmissionProgram->sessionid)
		->where('programid',$aAdmissionProgram->programid)
		->where('groupid',$aAdmissionProgram->groupid)
		->where('mediumid',$aAdmissionProgram->mediumid)
		->where('shiftid',$aAdmissionProgram->shiftid)
		->exists();
		if(!$hasItem){
			$aAdmissionProgram->save();
		}else{
        // This item already assign
		}
		return redirect('admissionprogram');
	}
	public function edit($id){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('admissionprogram');
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
			$aAdmissionProgram=AdmissionProgram::findOrfail($id);
			$sessionList=Session::all();
			$programList=Program::all();
			$groupList=Group::all();
			$mediumList=Medium::all();
			$shiftList=Shift::all();
			if($rh->getRoleId()==1){
				$instituteList=\DB::table('institute')
				->select('id','name')
				->get();
				return view('institutesettings.admissionprogram.edit',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList,'bean'=>$aAdmissionProgram]);
			}else{
				$aInstitute=\DB::table('institute')
				->select('id','name')
				->where('userid',$rh->getUserId())
				->first();
				return view('institutesettings.admissionprogram.edit',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList,'bean'=>$aAdmissionProgram]);
			}
		}else{
			return redirect('admissionprogram');
		}
	}
	public function update(Request $request, $id){
		$aAdmissionProgram=AdmissionProgram::findOrfail($id);
		$aAdmissionProgram->instituteid=$request->instituteid;
		$aAdmissionProgram->sessionid=$request->sessionid;
		$aAdmissionProgram->programid=$request->programid;
		$aAdmissionProgram->groupid=$request->groupid;
		$aAdmissionProgram->mediumid=$request->mediumid;
		$aAdmissionProgram->shiftid=$request->shiftid;
		$hasItem=\DB::table('admissionprogram')
		->select('admissionprogram.*')
		->where('instituteid',$aAdmissionProgram->instituteid)
		->where('sessionid',$aAdmissionProgram->sessionid)
		->where('programid',$aAdmissionProgram->programid)
		->where('groupid',$aAdmissionProgram->groupid)
		->where('mediumid',$aAdmissionProgram->mediumid)
		->where('shiftid',$aAdmissionProgram->shiftid)
		->exists();
		if(!$hasItem){
			$aAdmissionProgram->update();
		}else{
        // This item already assign
		}
		return redirect('admissionprogram');
	}
}
