<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
use App\institutesettings\Institute;
use App\settings\Session;
use App\settings\Program;
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
			// dd($admissionprogramList);
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
			->where('instituteid',$instituteId)
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
				if($rh->getRoleId()==1){
					$instituteList=\DB::table('institute')
					->select('id','name')
					->get();
					return view('institutesettings.admissionprogram.create',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList,'sessionList'=>$sessionList]);
			}else{
					$aInstitute=\DB::table('institute')
					->select('id','name')
					->where('userid',$rh->getUserId())
					->first();
					return view('institutesettings.admissionprogram.create',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId()]);
			}
		}else{
			return redirect('admissionprogram');
		}
    }
    public function store(Request $request){
        
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
    }
    public function update(Request $request, $id){
    	
    }
}
