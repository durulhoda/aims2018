<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\institutesettings\Domain;
use App\institutesettings\Institute;
use App\role\RoleHelper;
class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$rh=new RoleHelper();
        $aMenu=$rh->getMenuId('domain');
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
         if($rh->getRoleId()==1){
             $domainList=\DB::select('SELECT * FROM `domains`');
           }else{
                $domainList=\DB::select('SELECT * FROM `domains`
WHERE instituteid=?',[$rh->getInstituteId()]);
           }
        return view('institutesettings.domain.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$domainList,'roleid'=>$roleid]);
    }
    public function create(){
        $rh=new RoleHelper();
        $aMenu=$rh->getMenuId('domain');
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
        if($permission[2]==1){
           if($rh->getRoleId()==1){
             $instituteList=\DB::select('SELECT * FROM `institute`');
           }else{
                $instituteList=\DB::select('SELECT * FROM `institute`
WHERE userid=?',[$rh->getUserId()]);
           }
            return view('institutesettings.domain.create',['sidebarMenu'=>$sidebarMenu,'instituteList'=>$instituteList,'roleid'=>$roleid]);
        }else{
            return redirect('domain');
        }
    }
    public function store(Request $request){
        $aDomain=new Domain();
        $aDomain->name=$request->name;
        $aDomain->instituteid=$request->instituteid;
        $aDomain->save();
        return redirect('domain');
    }
    public function edit($id){
        $rh=new RoleHelper();
        $aMenu=$rh->getMenuId('domain');
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
        if($permission[4]==1){
            if($rh->getRoleId()==1){
             $instituteList=\DB::select('SELECT * FROM `institute`');
           }else{
                $instituteList=\DB::select('SELECT * FROM `institute`
WHERE userid=?',[$rh->getUserId()]);
           }
            $aDomain=Domain::findOrfail($id);
            return view('institutesettings.domain.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aDomain,'instituteList'=>$instituteList,'roleid'=>$roleid]);
        }else{
            return redirect('domain');
        }
    }
    public function update(Request $request, $id){
    	$aDomain=Domain::findOrfail($id);
        $aDomain->name=$request->name;
        $aDomain->instituteid=$request->instituteid;
        $aDomain->update();
        return redirect('domain');
    }

}
