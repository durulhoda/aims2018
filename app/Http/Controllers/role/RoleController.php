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
        $sidebarMenu=$rh->getMenu();
        $menuid=$rh->getMenuId('role1');
        $permission=$rh->getPermission($menuid);
        $roleid=$rh->getRoleId();
        $roleList=Role::all();
    	return view('roleconfig.role1.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$roleList]);
    }
    public function create(){
    	$rh=new RoleHelper();
        $sidebarMenu=$rh->getMenu();
        $menuid=$rh->getMenuId('role1');
        $permission=$rh->getPermission($menuid);
        $menuListByRole=$rh->getMenuListByRole();
        $successorRole=$rh->getSuccessorRole();
        $permissionNameList=$rh->getPermissionNamebyLevel();
        if($permission[2]==1){
           return view('roleconfig.role1.create',['sidebarMenu'=>$sidebarMenu,'menus'=>$menuListByRole,'successorRole'=>$successorRole,'permissionNameList'=>$permissionNameList]);
        }else{
            return redirect('role1');   
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
        return redirect('role1');
    }
    public function edit($id){
        $sidebarMenu=Role::getMenu();
        return view('roleconfig.role1.edit',['sidebarMenu'=>$sidebarMenu]);
    }
    public function update(Request $request, $id){
    	
    }
}
