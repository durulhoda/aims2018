<?php

namespace App\Http\Controllers\settings;
use App\role\RoleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\settings\Shift;
use App\settings\Section;
class ShiftController extends Controller
{
	public function __construct()
{
    $this->middleware('auth');
}
	public function index(){
		$rh=new RoleHelper();
        $aMenu=$rh->getMenuId('shift');
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
        $aShift=new Shift();
        if($roleid==1){
            $result=$aShift->getAllShifts();
        }else{
            $aInstitute=$rh->getInstitute();
            $result=$aShift->getAllShifts($aInstitute->id);
        }
        foreach ($result as $aBean) {
			$aBean->startTime=date("g:i a", strtotime($aBean->startTime));
			$aBean->endTime=date("g:i a", strtotime($aBean->endTime));
		}
        return view('settings.shift.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission,'roleid'=>$roleid]);
	}
	public function create(){
		$rh=new RoleHelper();
        $aMenu=$rh->getMenuId('shift');
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
                $instituteList=$rh->getInstituteList();
                return view('settings.shift.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$roleid,'instituteList'=>$instituteList]);
            }else{
                 $aInstitute=$rh->getInstitute();
                return view('settings.shift.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$roleid,'aInstitute'=>$aInstitute]);
             }
		}else{
			return redirect('shift');
		}
		
	}
	public function store(Request $request){
		$aShift=new Shift();
		$aShift->instituteid=$request->instituteid;
		$aShift->name=$request->name;
		$aShift->startTime=$request->startTime;
		$aShift->endTime=$request->endTime;
		$aShift->startTime=date("H:i", strtotime($aShift->startTime));
		$aShift->endTime=date("H:i", strtotime($aShift->endTime));
		// echo $aShift->endTime;
		$hasItem=\DB::table('shifts')
        ->select('shifts.*')
        ->where('instituteid',$aShift->instituteid)
        ->where('name',$aShift->name)
        ->where('startTime',$aShift->startTime)
        ->where('endTime',$aShift->startTime)
        ->exists();
         if(!$hasItem){
            $aShift->save();
        }else{
            // This item already assign
        }
		return redirect('shift');
	}
	public function edit($id)
	{
		$rh=new RoleHelper();
        $aMenu=$rh->getMenuId('shift');
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
			$aShift=Shift::findOrfail($id);
			$aShift->startTime=date("g:i a", strtotime($aShift->startTime));
			$aShift->endTime=date("g:i a", strtotime($aShift->endTime));
			$roleid=$rh->getRoleId();
           if($roleid==1){
                $instituteList=$rh->getInstituteList();
                return view('settings.shift.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aShift,'roleid'=>$roleid,'instituteList'=>$instituteList]);
              }else{
                $aInstitute=$rh->getInstitute();
                return view('settings.shift.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aShift,'roleid'=>$roleid,'aInstitute'=>$aInstitute]);
              }
		}else{
			return redirect('shift');
		}
		
	}
	public function update(Request $request, $id)
	{
		$aShift=Shift::findOrfail($id);
		$aShift->name=$request->name;
		$aShift->startTime=$request->startTime;
		$aShift->endTime=$request->endTime;
		$aShift->startTime=date("H:i", strtotime($aShift->startTime));
		$aShift->endTime=date("H:i", strtotime($aShift->endTime));
		$hasItem=\DB::table('shifts')
        ->select('shifts.*')
        ->where('instituteid',$aShift->instituteid)
        ->where('name',$aShift->name)
        ->where('startTime',$aShift->startTime)
        ->where('endTime',$aShift->startTime)
        ->exists();
         if(!$hasItem){
            $aShift->update();
        }else{
            // This item already assign
        }
		return redirect('shift');
	}
}
