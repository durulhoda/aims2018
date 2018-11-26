<?php

namespace App\Http\Controllers\institutesettings;

use App\institutesettings\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use App\role\RoleHelper;
class DivisionController extends Controller
{

public function __construct()
{
    $this->middleware('auth');
}
public function index()
{
    $rh=new RoleHelper();
    $menuid=$rh->getMenuId('division');
    $hasMenu=$rh->hasMenu($menuid);
    if($hasMenu==false){
        return redirect('error');
    }
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
    $result=Division::all();
    return view('institutesettings.division.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
}
public function create(){
    $rh=new RoleHelper();
    $menuid=$rh->getMenuId('division');
    $hasMenu=$rh->hasMenu($menuid);
    if($hasMenu==false){
        return redirect('error');
    }
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
    if($permission[2]==1){
        return view('institutesettings.division.create',['sidebarMenu'=>$sidebarMenu]);
    }else{
        return redirect('division');
    }

}
public function store(Request $request){
    $aBean=new Division();
    $aBean->name=$request->name;
    $aBean->save();
    return redirect('division');
}
public function edit($id)
{
    $rh=new RoleHelper();
    $menuid=$rh->getMenuId('division');
    $hasMenu=$rh->hasMenu($menuid);
    if($hasMenu==false){
        return redirect('error');
    }
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
    if($permission[4]==1){
       $aBean=Division::findOrfail($id);
       return view('institutesettings.division.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
   }else{
    return redirect('division');
}
}
public function update(Request $request, $id)
{
    $aBean=Division::findOrfail($id);
    $aBean->name=$request->name;
    $aBean->update();
    return redirect('division');
}
}
