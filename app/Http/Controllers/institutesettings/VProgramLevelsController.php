<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\settings\Program;
use App\settings\ProgramLevel;
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
    return view('institutesettings.vprogramlevel.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission]);
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
        return view('institutesettings.vprogramlevel.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'levelList'=>$levelList]);
    }else{
        return redirect('institutetype');
    }
}
public function store(Request $request){

}
public function edit($id){

}
public function update(Request $request, $id){

}
}
