<?php

namespace App\Http\Controllers\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
use App\role\RoleMenu;
use App\role\Role;
class RoleController extends Controller
{
    public function index(){
    	$rh=new RoleHelper();
        $menuid=$rh->getMenuId('role');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $roleList=$rh->getExcludeSuccessorRole();
        // $roleList=$rh->getOwnRoleList();
    	return view('roleconfig.role.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$roleList]);
    }
    public function create(){
    	$rh=new RoleHelper();
        $menuid=$rh->getMenuId('role');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $successorRole=$rh->getIncludeSuccessorRole();
        $menuListByRole=$rh->getMenuListByRole();
        $permissionNameList=$rh->getPermissionNamebyLevel();
        if($permission[2]==1){
           return view('roleconfig.role.create',['sidebarMenu'=>$sidebarMenu,'menuListByRole'=>$menuListByRole,'successorRole'=>$successorRole,'permissionNameList'=>$permissionNameList]);
        }else{
            return redirect('role');   
        }
    }
    public function store(Request $request){
        $name=$request->name;
        $rolecreatorid=$request->rolecreatorid;
        $instituteid=0;
        $newRoleId=\DB::table('roles')->insertGetId(['name'=>$name,'rolecreatorid'=>$rolecreatorid,'instituteid'=>$instituteid]);
        $selectmenu=$request->menu_id;
        if($selectmenu!=null){
        foreach ($selectmenu as $item) {
            $aRoleMenu=new RoleMenu();
            $aRoleMenu->role_id=$newRoleId;
            $aRoleMenu->menu_id=$item;
            if(isset($_POST["permissionvalue_".$item])){
                 $permissionvalue=$_POST["permissionvalue_".$item];
                 $sum=0;
                foreach ($permissionvalue as $key => $value) {
                   $sum=$sum+$value;
                }
                $aRoleMenu->permissionvalue=$sum;
                $aRoleMenu->save();
            }
          }
        }
        return redirect('role');
    }
    public function edit($id){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('role');
         $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $successorRole=$rh->getIncludeSuccessorRole();
        $aRole=Role::findOrfail($id);
        $parentid=$aRole->rolecreatorid;
        $result=$rh->getRoleEditMenuList($parentid,$id);
        $permissionNameList=$rh->getPermissionNamebyLevel();
        if($permission[4]==1){
            return view('roleconfig.role.edit',['sidebarMenu'=>$sidebarMenu,'successorRole'=>$successorRole,'bean'=>$aRole,'result'=>$result,'permissionNameList'=>$permissionNameList]);
        }else{
            return redirect('role');
        }
    }
    public function update(Request $request, $id){
        $aRole=Role::findOrfail($id);
    	$aRole->name=$request->name;
        $aRole->rolecreatorid=$request->rolecreatorid;
        $aRole->update();
        \DB::select('DELETE  FROM `role_menu` WHERE role_id=?',[$id]);
        $selectmenu=$request->menu_id;
        if($selectmenu!=null){
        foreach ($selectmenu as $item) {
            $aRoleMenu=new RoleMenu();
            $aRoleMenu->role_id=$id;
            $aRoleMenu->menu_id=$item;
            if(isset($_POST["permissionvalue_".$item])){
                 $permissionvalue=$_POST["permissionvalue_".$item];
                 $sum=0;
                foreach ($permissionvalue as $key => $value) {
                   $sum=$sum+$value;
                }
                $aRoleMenu->permissionvalue=$sum;
                $aRoleMenu->save();
            }
          }
        }
        return redirect('role');
    }
}
