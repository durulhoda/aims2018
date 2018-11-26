<?php

namespace App\Http\Controllers\settings;
use App\role\RoleHelper;
use App\Http\Controllers\Controller;

use App\settings\ProgramLevel;
use Illuminate\Http\Request;

class ProgramLevelController extends Controller
{
   public function __construct()
{
    $this->middleware('auth');
}
    public function index()
    {
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('programLevel');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $result=ProgramLevel::all();
        return view('settings.programLevel.index',compact('sidebarMenu','result','permission'));
    }
    public function create()
    {
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('programLevel');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[2]==1){
             return view('settings.programLevel.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
             return redirect('programLevel');
        }
       
    }

   
    public function store(Request $request)
    {
        $aBean=new ProgramLevel();
        $aBean->name=$request->name;
        $aBean->save();
        return redirect('programLevel');
    }

    public function edit($id)
    {
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('programLevel');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $aBean=ProgramLevel::findOrfail($id);
        if($permission[4]==1){
            return view('settings.programLevel.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
        }else{
            return redirect('programLevel');
        }
       
    }

    public function update(Request $request,$id)
    {
        $aBean = ProgramLevel::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->update();
        return redirect('programLevel');
    }
}
