<?php

namespace App\Http\Controllers\settings;
use App\role\RoleHelper;
use App\Http\Controllers\Controller;

use App\settings\ProgramLevel;
use Illuminate\Http\Request;

class ProgramLevelController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth');
}
public function index()
{
    $rh=new RoleHelper();
    $aMenu=$rh->getMenuId('programLevel');
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
    $result=\DB::table('programlevels')
      ->join('institute', 'programlevels.instituteid', '=', 'institute.id')
      ->select('programlevels.*','institute.name AS instituteName')
      ->get();
  }else{
    $instituteId=$rh->getInstituteId($rh->getRoleId());
    $result=\DB::table('programlevels')
      ->join('institute', 'programlevels.instituteid', '=', 'institute.id')
      ->select('programlevels.*','institute.name AS instituteName')
      ->where('instituteid',$instituteId)
      ->get();
  }
  return view('settings.programLevel.index',compact('sidebarMenu','result','permission','roleid'));
}
public function create()
{
    $rh=new RoleHelper();
    $aMenu=$rh->getMenuId('programLevel');
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
          return view('settings.programLevel.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList]);
          }else{
          $aInstitute=\DB::table('institute')
          ->select('id','name')
          ->where('userid',$rh->getUserId())
          ->first();
          return view('settings.programLevel.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute]);
        }
 }else{
     return redirect('programLevel');
 }
 
}


public function store(Request $request)
{
    $aProgramLevel=new ProgramLevel();
    $aProgramLevel->instituteid=$request->instituteid;
    $aProgramLevel->name=$request->name;
    $hasItem=\DB::table('programlevels')
      ->select('programlevels.*')
      ->where('instituteid',$aProgramLevel->instituteid)
      ->where('name',$aProgramLevel->name)
      ->exists();
       if(!$hasItem){
          $aProgramLevel->save();
      }else{
          // This item already assign
      }
    return redirect('programLevel');
}

public function edit($id)
{
 $rh=new RoleHelper();
 $aMenu=$rh->getMenuId('programLevel');
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
    $aProgramLevel=ProgramLevel::findOrfail($id);
       if($rh->getRoleId()==1){
            $instituteList=\DB::table('institute')
            ->select('id','name')
            ->get();
            return view('settings.programLevel.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aProgramLevel,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList]);
          }else{
            $aInstitute=\DB::table('institute')
            ->select('id','name')
            ->where('userid',$rh->getUserId())
            ->first();
            return view('settings.programLevel.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aProgramLevel,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute]);
        }
}else{
    return redirect('programLevel');
}

}

public function update(Request $request,$id)
{
    $aProgramLevel = ProgramLevel::findOrfail($id);
    $aProgramLevel->instituteid=$request->instituteid;
    $aProgramLevel->name=$request->name;
    $hasItem=\DB::table('programlevels')
      ->select('programlevels.*')
      ->where('instituteid',$aProgramLevel->instituteid)
      ->where('name',$aProgramLevel->name)
      ->exists();
       if(!$hasItem){
          $aProgramLevel->update();
      }else{
          // This item already assign
      }
    return redirect('programLevel');
}
}
