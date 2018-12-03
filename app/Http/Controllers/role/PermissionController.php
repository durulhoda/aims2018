<?php

namespace App\Http\Controllers\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\Permission;
use App\role\RoleHelper;
class PermissionController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }
    public function index(){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('permission');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $permissionList=Permission::all();
    	return view('roleconfig.permission.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$permissionList]);
    }
    public function create(){
    	$rh=new RoleHelper();
        $menuid=$rh->getMenuId('permission');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        return view('roleconfig.permission.create',['sidebarMenu'=>$sidebarMenu]);
    }
    public function store(Request $request){
        $rh=new RoleHelper();
        $lastitem=$rh->getLastItem('permissions');
        $aPermission=new Permission();
        $aPermission->name=$request->name;
        if($lastitem!=null){
            $aPermission->level=$lastitem->level*2;
        }else{
            $aPermission->level=1;
        }
        $aPermission->save();
        \DB::table('role_menu')
                ->where('roleid',1)
                ->update(['permissionvalue' =>$rh->getPermissionValue()]);
        return redirect('permission');
    }
    public function edit($id){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('permission');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $aPermission=Permission::findOrfail($id);
        return view('roleconfig.permission.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aPermission]);
    }
    public function update(Request $request, $id){
    	$aPermission=Permission::findOrfail($id);
        $aPermission->name=$request->name;
        $aPermission->update();
        return redirect('permission');
    }
}
