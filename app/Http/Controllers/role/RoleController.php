<?php

namespace App\Http\Controllers\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
use App\role\Role;
class RoleController extends Controller
{
    public function index(){
    	$rh=new RoleHelper();
        $menuid=$rh->getMenuId('menu');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $roleid=$rh->getRoleId();
        $roleList=Role::all();
    	return view('roleconfig.role1.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$roleList]);
    }
    public function create(){
    	$rh=new RoleHelper();
        $menuid=$rh->getMenuId('menu');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $menuListByRole=$rh->getMenuByRole();
        $rolecreatorid=$rh->getRoleCreatorId();
        $successorRole=$rh->getSuccessorRole();
        dd($successorRole);
        if($permission[2]==1){
           return view('roleconfig.role1.create',['sidebarMenu'=>$sidebarMenu,'menus'=>$menuListByRole]);
        }else{
            return redirect('role1');   
        }
    }
    public function store(Request $request){
    }
    public function edit($id){
        $sidebarMenu=Role::getMenu();
        return view('roleconfig.role1.edit',['sidebarMenu'=>$sidebarMenu]);
    }
    public function update(Request $request, $id){
    	
    }
}
