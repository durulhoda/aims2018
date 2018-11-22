<?php

namespace App\Http\Controllers\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\role\Permission;
use App\role\RoleHelper;
class PermissionController extends Controller
{

    public function index(){
        $rh=new RoleHelper();
        $sidebarMenu=Role::getMenu();
        $roleid=$rh->getRoleId();
        $menuid=$rh->getMenuId('permission');
        $permissionList=Permission::all();
    	return view('roleconfig.permission.index',['sidebarMenu'=>$sidebarMenu,'result'=>$permissionList]);
    }
    public function create(){
    	$sidebarMenu=Role::getMenu();
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
                ->where('role_id',1)
                ->update(['permissionvalue' =>$rh->getPermissionValue()]);
        return redirect('permission');
    }
    public function edit($id){
        $sidebarMenu=Role::getMenu();
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
