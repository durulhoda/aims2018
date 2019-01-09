<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\settings\Program;
use App\settings\ProgramLevel;
use App\institutesettings\Institute;
use App\institutesettings\VProgramLevel;
use App\role\RoleHelper;

class VProgramLevelsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index($msg=null){
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
    $aVProgramLevel=new VProgramLevel();
    if($rh->getRoleId()==1){
        $vprogramlevelList=$aVProgramLevel->getAllProgramLevel();
    }else{
        $aInstitute=$rh->getInstitute();
        $vprogramlevelList=$aVProgramLevel->getAllProgramLevel($aInstitute->id);
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
        if($rh->getRoleId()==1){
            $instituteList=$rh->getInstituteList();
            $programList=array();
            $levelList=array();
            return view('institutesettings.vprogramlevel.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'levelList'=>$levelList,'instituteList'=>$instituteList,'roleid'=>$rh->getRoleId()]);
       }else{
            $aInstitute=$rh->getInstitute();
            $programList=\DB::table('programs')
            ->select('id','name')
            ->where('programs.instituteid',$aInstitute->id)
            ->get();
            $levelList=\DB::table('programlevels')
            ->select('id','name')
            ->where('programlevels.instituteid',$aInstitute->id)
            ->get();
           return view('institutesettings.vprogramlevel.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'levelList'=>$levelList,'aInstitute'=>$aInstitute,'roleid'=>$rh->getRoleId()]);
       }
   }else{
    return redirect('vprogramlevels');
}
}
public function store(Request $request){
    $aVProgramLevel=new VProgramLevel();
    $aVProgramLevel->programid=$request->programid;
    $aVProgramLevel->programlevelid=$request->programlevelid;
    $hasItem=\DB::table('vprogramlevels')
        ->select('vprogramlevels.*')
        ->where('programid',$aVProgramLevel->programid)
        ->where('programlevelid',$aVProgramLevel->programlevelid)
        ->exists();
    if(!$hasItem){
        $msg="Level is assign successfuly";
         $aVProgramLevel->save();
    }else{
         $msg="Level is already assign to this program";
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
        $aVProgramLevel=\DB::select("SELECT vprogramlevels.*,programs.instituteid FROM `vprogramlevels` 
INNER JOIN programlevels ON vprogramlevels.programlevelid=programlevels.id
INNER JOIN programs ON vprogramlevels.programid=programs.id
WHERE vprogramlevels.id=?",[$id])[0];
        $programList=\DB::select("SELECT * FROM `programs` WHERE `instituteid`=?",[$aVProgramLevel->instituteid]);
        $levelList=\DB::select("SELECT * FROM `programlevels` WHERE `instituteid`=?",[$aVProgramLevel->instituteid]);
        if($rh->getRoleId()==1){
           $instituteList=$rh->getInstituteList();
           return view('institutesettings.vprogramlevel.edit',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'levelList'=>$levelList,'instituteList'=>$instituteList,'bean'=>$aVProgramLevel,'roleid'=>$rh->getRoleId()]);
       }else{
           $aInstitute=$rh->getInstitute();
           return view('institutesettings.vprogramlevel.edit',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'levelList'=>$levelList,'aInstitute'=>$aInstitute,'bean'=>$aVProgramLevel,'roleid'=>$rh->getRoleId()]);
       }
   }else{
    return redirect('vprogramlevels');
}
}
public function update(Request $request, $id){
    $aVProgramLevel=VProgramLevel::findOrfail($id);
    $aVProgramLevel->programid=$request->programid;
    $aVProgramLevel->programlevelid=$request->programlevelid;
    $hasItem=\DB::table('vprogramlevels')
        ->select('vprogramlevels.*')
        ->where('programid',$aVProgramLevel->programid)
        ->where('programlevelid',$aVProgramLevel->programlevelid)
        ->exists();
    if(!$hasItem){
        $aVProgramLevel->update();
    }else{
        // This item already assign
    }
    return redirect('vprogramlevels');
  }
}
