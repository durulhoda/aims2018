<?php

namespace App\Http\Controllers\settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
use App\settings\ProgramOffer;
use App\institutesettings\Institute;
use App\settings\Session;
use App\settings\Program;
use App\settings\Group;
use App\settings\Medium;
use App\settings\Shift;
class ProgramOfferController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  public function index(){
    $rh=new RoleHelper();
    $aMenu=$rh->getMenuId('programoffer');
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
      $programofferList=\DB::table('programoffer')
      ->join('institute', 'programoffer.instituteid', '=', 'institute.id')
      ->join('sessions', 'programoffer.sessionid', '=', 'sessions.id')
      ->join('programs', 'programoffer.programid', '=', 'programs.id')
      ->join('groups', 'programoffer.groupid', '=', 'groups.id')
      ->join('mediums', 'programoffer.mediumid', '=', 'mediums.id')
      ->join('shifts', 'programoffer.shiftid', '=', 'shifts.id')
      ->select('programoffer.id','institute.name AS instituteName','sessions.name AS sessionName','programs.name AS programName','groups.name AS groupName','mediums.name AS mediumName','shifts.name AS shiftName')
      ->orderByRaw('id')
      ->get();
    }else{
      $instituteId=$rh->getInstituteId($rh->getRoleId());
      $programofferList=\DB::table('programoffer')
      ->join('institute', 'programoffer.instituteid', '=', 'institute.id')
      ->join('sessions', 'programoffer.sessionid', '=', 'sessions.id')
      ->join('programs', 'programoffer.programid', '=', 'programs.id')
      ->join('groups', 'programoffer.groupid', '=', 'groups.id')
      ->join('mediums', 'programoffer.mediumid', '=', 'mediums.id')
      ->join('shifts', 'programoffer.shiftid', '=', 'shifts.id')
      ->select('programoffer.id','institute.name AS instituteName','sessions.name AS sessionName','programs.name AS programName','groups.name AS groupName','mediums.name AS mediumName','shifts.name AS shiftName')
      ->orderByRaw('id')
      ->where('programoffer.instituteid',$instituteId)
      ->get();
    }
    return view('settings.programoffer.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$programofferList,'roleid'=>$rh->getRoleId()]);
  }
  public function create(){
    $rh=new RoleHelper();
    $aMenu=$rh->getMenuId('programoffer');
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
        $instituteList=$rh->getInstituteList();
        $sessionList=array();
        $programList=array();
        $groupList=array();
        $mediumList=array();
        $shiftList=array();
        return view('settings.programoffer.create',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList]);
      }else{
        $aInstitute=$rh->getInstitute();
        $sessionList=\DB::table('sessions')
        ->select('id','name')
        ->where('sessions.instituteid',$aInstitute->id)
        ->get();
        $programList=\DB::table('programs')
        ->select('id','name')
        ->where('programs.instituteid',$aInstitute->id)
        ->get();
       
        $groupList=array();
        $mediumList=\DB::table('mediums')
        ->select('id','name')
        ->where('mediums.instituteid',$aInstitute->id)
        ->get();
        $shiftList=\DB::table('shifts')
        ->select('id','name')
        ->where('shifts.instituteid',$aInstitute->id)
        ->get();
        return view('settings.programoffer.create',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList]);
      }
    }else{
      return redirect('programoffer');
    }
  }
  public function store(Request $request){
    $aProgramOffer=new ProgramOffer();
    $aProgramOffer->instituteid=$request->instituteid;
    $aProgramOffer->sessionid=$request->sessionid;
    $aProgramOffer->programid=$request->programid;
    $aProgramOffer->groupid=$request->groupid;
    $aProgramOffer->mediumid=$request->mediumid;
    $aProgramOffer->shiftid=$request->shiftid;
    $hasItem=\DB::table('programoffer')
    ->select('programoffer.*')
    ->where('instituteid',$aProgramOffer->instituteid)
    ->where('sessionid',$aProgramOffer->sessionid)
    ->where('programid',$aProgramOffer->programid)
    ->where('groupid',$aProgramOffer->groupid)
    ->where('mediumid',$aProgramOffer->mediumid)
    ->where('shiftid',$aProgramOffer->shiftid)
    ->exists();
    if(!$hasItem){
      $aProgramOffer->save();
    }else{
        // This item already assign
    }
    return redirect('programoffer');
  }
  public function edit($id){
    $rh=new RoleHelper();
    $aMenu=$rh->getMenuId('programoffer');
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
      $aProgramOffer=ProgramOffer::findOrfail($id);
      $sessionList=\DB::table('sessions')
      ->select('id','name')
      ->where('sessions.instituteid',$aProgramOffer->instituteid)
      ->get();
      $programList=\DB::table('programs')
      ->select('id','name')
      ->where('programs.instituteid',$aProgramOffer->instituteid)
      ->get();
      $groupList=\DB::table('groups')
      ->select('id','name')
      ->where('groups.instituteid',$aProgramOffer->instituteid)
      ->get();
      $mediumList=\DB::table('mediums')
      ->select('id','name')
      ->where('mediums.instituteid',$aProgramOffer->instituteid)
      ->get();
      $shiftList=\DB::table('shifts')
      ->select('id','name')
      ->where('shifts.instituteid',$aProgramOffer->instituteid)
      ->get();
      if($rh->getRoleId()==1){
        $instituteList=$rh->getInstituteList();
        return view('settings.programoffer.edit',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList,'bean'=>$aProgramOffer]);
      }else{
        $aInstitute=$rh->getInstitute();
        return view('settings.programoffer.edit',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute,'sessionList'=>$sessionList,'programList'=>$programList,'groupList'=>$groupList,'mediumList'=>$mediumList,'shiftList'=>$shiftList,'bean'=>$aProgramOffer]);
      }
    }else{
      return redirect('programoffer');
    }
  }
  public function update(Request $request, $id){
    $aProgramOffer=ProgramOffer::findOrfail($id);
    $aProgramOffer->instituteid=$request->instituteid;
    $aProgramOffer->sessionid=$request->sessionid;
    $aProgramOffer->programid=$request->programid;
    $aProgramOffer->groupid=$request->groupid;
    $aProgramOffer->mediumid=$request->mediumid;
    $aProgramOffer->shiftid=$request->shiftid;
    $hasItem=\DB::table('admissionprogram')
    ->select('admissionprogram.*')
    ->where('instituteid',$aProgramOffer->instituteid)
    ->where('sessionid',$aProgramOffer->sessionid)
    ->where('programid',$aProgramOffer->programid)
    ->where('groupid',$aProgramOffer->groupid)
    ->where('mediumid',$aProgramOffer->mediumid)
    ->where('shiftid',$aProgramOffer->shiftid)
    ->exists();
    if(!$hasItem){
      $aProgramOffer->update();
    }else{
        // This item already assign
    }
    return redirect('programoffer');
  }
}
