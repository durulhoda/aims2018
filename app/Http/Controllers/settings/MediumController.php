<?php

namespace App\Http\Controllers\settings;

use App\role\RoleHelper;
use App\settings\Medium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class MediumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $rh=new RoleHelper();
        $aMenu=$rh->getMenuId('medium');
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
        $aMedium=new Medium();
        if($roleid==1){
            $result=$aMedium->getAllMedium();
        }else{
            $aInstitute=$rh->getInstitute();
            $result=$aMedium->getAllMedium($aInstitute->id);
        }
        return view('settings.medium.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission,'roleid'=>$roleid]);
    }
    public function create()
    {
        $rh=new RoleHelper();
        $aMenu=$rh->getMenuId('medium');
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
                return view('settings.medium.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$roleid,'instituteList'=>$instituteList]);
            }else{
                $aInstitute=$rh->getInstitute();
                return view('settings.medium.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$roleid,'aInstitute'=>$aInstitute]);
             }
        }else{
            return redirect('medium');
        }
    }
    public function store(Request $request)
    {
        $aMedium=new Medium();
        $aMedium->name=$request->name;
        $aMedium->instituteid=$request->instituteid;
        $hasItem=\DB::table('mediums')
        ->select('mediums.*')
        ->where('instituteid',$aMedium->instituteid)
        ->where('name',$aMedium->name)
        ->exists();
         if(!$hasItem){
            $aMedium->save();
        }else{
            // This item already assign
        }
        return redirect('medium');
    }
    public function edit($id)
    {
        $rh=new RoleHelper();
        $aMenu=$rh->getMenuId('medium');
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
         $aMedium=Medium::findOrfail($id);
         $roleid=$rh->getRoleId();
         if($roleid==1){
                $instituteList=$rh->getInstituteList();
                return view('settings.medium.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aMedium,'roleid'=>$roleid,'instituteList'=>$instituteList]);
              }else{
                $aInstitute=$rh->getInstitute();
                return view('settings.medium.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aMedium,'roleid'=>$roleid,'aInstitute'=>$aInstitute]);
              }
        }else{
            return redirect('medium');
        }
    }

    public function update(Request $request, $id)
    {
        $aMedium=Medium::findOrfail($id);
        $aMedium->name=$request->name;
        $aMedium->instituteid=$request->instituteid;
        $hasItem=\DB::table('mediums')
        ->select('mediums.*')
        ->where('instituteid',$aMedium->instituteid)
        ->where('name',$aMedium->name)
        ->exists();
         if(!$hasItem){
            $aMedium->update();
        }else{
            // This item already assign
        }
        return redirect('medium');
    }
}
