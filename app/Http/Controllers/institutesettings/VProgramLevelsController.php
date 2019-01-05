<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\settings\Program;
use App\settings\ProgramLevel;
use App\settings\Session;
use App\institutesettings\Institute;
use App\institutesettings\VProgramLevel;
use App\role\RoleHelper;

class VProgramLevelsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
       $rh=new RoleHelper();
       $aMenu=$rh->getMenuId('vprogramlevels');
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
        $vprogramlevelList=\DB::table('vprogramlevels')
        ->join('institute', 'vprogramlevels.instituteid', '=', 'institute.id')
        ->join('sessions', 'vprogramlevels.sessionid', '=', 'sessions.id')
        ->join('programs', 'vprogramlevels.programid', '=', 'programs.id')
        ->join('programlevels', 'vprogramlevels.programlevelid', '=', 'programlevels.id')
        ->select('vprogramlevels.id','institute.name AS instituteName','sessions.name AS sessionName','programs.name AS programName','programlevels.name AS levelName')
        ->orderByRaw('id')
        ->get();
    }else{
        $instituteId=$rh->getInstituteId($rh->getRoleId());
        $vprogramlevelList=\DB::table('vprogramlevels')
        ->join('institute', 'vprogramlevels.instituteid', '=', 'institute.id')
        ->join('sessions', 'vprogramlevels.sessionid', '=', 'sessions.id')
        ->join('programs', 'vprogramlevels.programid', '=', 'programs.id')
        ->join('programlevels', 'vprogramlevels.programlevelid', '=', 'programlevels.id')
        ->select('vprogramlevels.id','institute.name AS instituteName','sessions.name AS sessionName','programs.name AS programName','programlevels.name AS levelName')
        ->orderByRaw('id')
        ->where('instituteid',$instituteId)
        ->get();
    }
    return view('institutesettings.vprogramlevel.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'vprogramlevelList'=>$vprogramlevelList]);
}
public function create(){
    $rh=new RoleHelper();
    $aMenu=$rh->getMenuId('vprogramlevels');
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
        $levelList=ProgramLevel::all();
        $sessionList=Session::all();
        if($rh->getRoleId()==1){
           $instituteList=\DB::table('institute')
           ->select('id','name')
           ->get();
           return view('institutesettings.vprogramlevel.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'levelList'=>$levelList,'sessionList'=>$sessionList,'instituteList'=>$instituteList,'roleid'=>$rh->getRoleId()]);
       }else{
           $aInstitute=\DB::table('institute')
           ->select('id','name')
           ->where('userid',$rh->getUserId())
           ->first();
           return view('institutesettings.vprogramlevel.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'levelList'=>$levelList,'sessionList'=>$sessionList,'aInstitute'=>$aInstitute,'roleid'=>$rh->getRoleId()]);
       }
   }else{
    return redirect('vprogramlevels');
}
}
public function store(Request $request){
    $aVProgramLevel=new VProgramLevel();
    $aVProgramLevel->instituteid=$request->instituteid;
    $aVProgramLevel->sessionid=$request->sessionid;
    $aVProgramLevel->programid=$request->programid;
    $aVProgramLevel->programlevelid=$request->programlevelid;
    $hasItem=\DB::table('vprogramlevels')
        ->select('vprogramlevels.*')
        ->where('instituteid',$aVProgramLevel->instituteid)
        ->where('sessionid', $aVProgramLevel->sessionid)
        ->where('programid',$aVProgramLevel->programid)
        ->exists();
    if(!$hasItem){
         $aVProgramLevel->save();
    }else{
        // Level is already Assign to program
    }
    return redirect('vprogramlevels');
}
public function edit($id){
    $rh=new RoleHelper();
    $aMenu=$rh->getMenuId('vprogramlevels');
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
        $levelList=ProgramLevel::all();
        $sessionList=Session::all();
        $aVProgramLevel=VProgramLevel::findOrfail($id);
        if($rh->getRoleId()==1){
           $instituteList=\DB::table('institute')
           ->select('id','name')
           ->get();
           return view('institutesettings.vprogramlevel.edit',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'levelList'=>$levelList,'sessionList'=>$sessionList,'instituteList'=>$instituteList,'bean'=>$aVProgramLevel,'roleid'=>$rh->getRoleId()]);
       }else{
           $aInstitute=\DB::table('institute')
           ->select('id','name')
           ->where('userid',$rh->getUserId())
            ->first();
           return view('institutesettings.vprogramlevel.edit',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'levelList'=>$levelList,'sessionList'=>$sessionList,'aInstitute'=>$aInstitute,'bean'=>$aVProgramLevel,'roleid'=>$rh->getRoleId()]);
       }
   }else{
    return redirect('vprogramlevels');
}
}
public function update(Request $request, $id){
    $aVProgramLevel=VProgramLevel::findOrfail($id);
    $aVProgramLevel->instituteid=$request->instituteid;
    $aVProgramLevel->sessionid=$request->sessionid;
    $aVProgramLevel->programid=$request->programid;
    $aVProgramLevel->programlevelid=$request->programlevelid;
    $hasItem=\DB::table('vprogramlevels')
        ->select('vprogramlevels.*')
        ->where('instituteid',$aVProgramLevel->instituteid)
        ->where('sessionid', $aVProgramLevel->sessionid)
        ->where('programid',$aVProgramLevel->programid)
        ->exists();
    if(!$hasItem){
        $aVProgramLevel->update();
    }else{
        // This item already assign
    }
    return redirect('vprogramlevels');
}
}
