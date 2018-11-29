<?php

namespace App\Http\Controllers\institutesettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\institutesettings\Domain;
use App\institutesettings\Institute;
use App\role\RoleHelper;
class DomainController extends Controller
{
    public function index(){
    	$rh=new RoleHelper();
        $menuid=$rh->getMenuId('domain');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $domainList=Domain::all();
        return view('institutesettings.domain.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$domainList]);
    }
    public function create(){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('domain');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[2]==1){
           if($rh->getRoleId()==1){
             $instituteList=\DB::select('SELECT * FROM `institute`');
           }else{
                $instituteList=\DB::select('SELECT * FROM `institute`
WHERE user_id=?',[$rh->getUserId()]);
           }
            return view('institutesettings.domain.create',['sidebarMenu'=>$sidebarMenu,'instituteList'=>$instituteList]);
        }else{
            return redirect('domain');
        }
    }
    public function store(Request $request){
        
    }
    public function edit($id){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('domain');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[4]==1){
            return view('institutesettings.domain.edit',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('domain');
        }
    }
    public function update(Request $request, $id){
    	
    }

}
