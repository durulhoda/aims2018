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
        $menuid=$rh->getMenuId('medium');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $result=Medium::all();
        return view('settings.medium.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
    }
    public function create()
    {
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('medium');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[2]==1){
         return view('settings.medium.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('medium');
        }
    }
    public function store(Request $request)
    {
        $aBean=new Medium();
        $aBean->name=$request->name;
        $aBean->save();
        return redirect('medium');
    }
    public function edit($id)
    {
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('medium');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[4]==1){
         $aMedium=Medium::findOrfail($id);
         return view('settings.medium.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aMedium]);
        }else{
            return redirect('medium');
        }
    }

    public function update(Request $request, $id)
    {
        $aBean=Medium::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->update();
        return redirect('medium');
    }
}
