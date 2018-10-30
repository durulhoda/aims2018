<?php

namespace App\Http\Controllers\settings;

use App\settings\ProgramLevel;
use App\settings\Program;
use App\settings\Medium;
use App\settings\Shift;
use App\settings\Group;
use App\settings\Session;
use App\settings\ProgramOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramOfferController extends Controller
{
  public function index(){
    $result=\DB::select('SELECT programoffer.*,sessions.name as sessionName,programs.name AS programName,groups.name as groupName,programlevels.name As levelName,mediums.name As mediumName,shifts.name AS shiftName FROM `programoffer`
      INNER JOIN sessions ON programoffer.sessionid=sessions.id
      INNER JOIN programs ON programoffer.programid=programs.id
      INNER JOIN groups ON programs.groupid=groups.id
      INNER JOIN programlevels ON groups.programLevelid=programlevels.id
      INNER JOIN mediums ON programoffer.mediumid=mediums.id
      INNER JOIN shifts ON programoffer.shiftid=shifts.id');
    return view('settings.programoffer.index',['result'=>$result]);
  }
  public function create(){
    $sessions=Session::all();
    $levels=ProgramLevel::all();
    $mediums=Medium::all();
    $shifts=Shift::all();
    $msg="";
    return view('settings.programoffer.create',['sessions'=>$sessions,'levels'=>$levels,'mediums'=>$mediums,'shifts'=>$shifts]);
  }
  public function store(Request $request){
    $aBean=new ProgramOffer();
    $aBean->sessionid=$request->sessionid;
    $aBean->programid=$request->programid;
    $aBean->mediumid=$request->mediumid;
    $aBean->shiftid=$request->shiftid;
    $aBean->applicantSeat=$request->applicantSeat;
    $aBean->quota=$request->quota;
    $sql="select * from programoffer where sessionid=? and programid=? and mediumid=? and shiftid=?";
    $isItemExit=\DB::select($sql,[$aBean->sessionid,$aBean->programlevelid,$aBean->programid,$aBean->mediumid,$aBean->groupid,$aBean->shiftid]);
    if(!$isItemExit){
      $aBean->save();
    }else{
     $msg="This Offer Is Already Created";
     return redirect('programoffer/create')->with('msg',$msg);
   }
   return redirect('programoffer');
 }
 public function edit($id)
 {
   $result=\DB::select('SELECT programoffer.*,sessions.name as sessionName,programs.name AS programName,groups.id as groupid,groups.name as groupName,programlevels.id As programLevelid,programlevels.name As levelName,mediums.name As mediumName,shifts.name AS shiftName FROM `programoffer`
    INNER JOIN sessions ON programoffer.sessionid=sessions.id
    INNER JOIN programs ON programoffer.programid=programs.id
    INNER JOIN groups ON programs.groupid=groups.id
    INNER JOIN programlevels ON groups.programLevelid=programlevels.id
    INNER JOIN mediums ON programoffer.mediumid=mediums.id
    INNER JOIN shifts ON programoffer.shiftid=shifts.id
    where programoffer.id=?',[$id]);
   $aBean=$result[0];

   $sessions=Session::all();
   $levels=ProgramLevel::all();
   $groups=\DB::select('SELECT groups.* FROM groups where programLevelid=?',[$aBean->programLevelid]);
   $programs=\DB::select('SELECT programs.* FROM programs where groupid=?',[$aBean->groupid]);
   $mediums=Medium::all();
    $shifts=Shift::all();
   return view('settings.programoffer.edit',['bean'=>$aBean,'sessions'=>$sessions,'levels'=>$levels,'groups'=>$groups,'programs'=>$programs,'mediums'=>$mediums,'shifts'=>$shifts]);
 }
 public function update(Request $request, $id)
 {
  $sql="select * from programoffer where sessionid=? and programid=? and mediumid=? and shiftid=? and id=?";
  $isSameItem=\DB::select($sql,[$request->sessionid,$request->programid,$request->mediumid,$request->shiftid,$id]);
  $aBean=ProgramOffer::findOrfail($id);
  $aBean->sessionid=$request->sessionid;
  $aBean->programid=$request->programid;
  $aBean->mediumid=$request->mediumid;
  $aBean->shiftid=$request->shiftid;
  $aBean->applicantSeat=$request->applicantSeat;
  $aBean->quota=$request->quota;
  if($isSameItem){
    $aBean->update();
  }else{
    $sql="select * from programoffer where sessionid=? and programid=? and mediumid=? and shiftid=?";
    $isItemExit=\DB::select($sql,[$request->sessionid,$request->programid,$request->mediumid,$request->shiftid]);
    if(!$isItemExit){
     $aBean->update();
   }else{
     $msg="This Offer Is Already Exist";
     return redirect('programoffer/'.$id.'/edit')->with('msg',$msg);
   }
 }

 return redirect('programoffer');
}

}
