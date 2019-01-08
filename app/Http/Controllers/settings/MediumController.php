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
        if($roleid==1){
            $result=\DB::table('mediums')
            ->join('institute', 'mediums.instituteid', '=', 'institute.id')
            ->select('mediums.*','institute.name AS instituteName')
            ->get();
        }else{
            $instituteId=$rh->getInstituteId($rh->getRoleId());
            $result=\DB::table('mediums')
            ->join('institute', 'mediums.instituteid', '=', 'institute.id')
            ->select('mediums.*','institute.name AS instituteName')
            ->where('instituteid',$instituteId)
            ->get();
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
                $instituteList=\DB::table('institute')
                ->select('id','name')
                ->get();
                return view('settings.medium.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$roleid,'instituteList'=>$instituteList]);
            }else{
                $aInstitute=\DB::table('institute')
                ->select('id','name')
                ->where('userid',$rh->getUserId())
                ->first();
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
                $instituteList=\DB::table('institute')
                ->select('id','name')
                ->get();
                return view('settings.medium.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aMedium,'roleid'=>$roleid,'instituteList'=>$instituteList]);
              }else{
                $aInstitute=\DB::table('institute')
                ->select('id','name')
                ->where('userid',$rh->getUserId())
                ->first();
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
