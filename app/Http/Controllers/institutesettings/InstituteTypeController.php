<?php

namespace App\Http\Controllers\institutesettings;
use App\Role;
use App\institutesettings\InstituteType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Role::checkAdmin()==1){
            $sidebarMenu=Role::getAllMenu();
        }else{
            $sidebarMenu=Role::getMenu();
        }
        $accessStatus=Role::getAccessStatus();
        $result=InstituteType::all();
        return view('institutesettings.institutetype.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if(Role::checkAdmin()==1){
            $sidebarMenu=Role::getAllMenu();
        }else{
            $sidebarMenu=Role::getMenu();
        }
        if($accessStatus[2]==1){
            return view('institutesettings.institutetype.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('institutetype');
        }
        
    }
    public function store(Request $request){
        $aObj=new InstituteType();
        $aObj->name=$request->name;
        $aObj->save();
        return redirect('institutetype');
    }
    public function edit($id)
    {
        $accessStatus=Role::getAccessStatus();
        if(Role::checkAdmin()==1){
            $sidebarMenu=Role::getAllMenu();
        }else{
            $sidebarMenu=Role::getMenu();
        }
        if($accessStatus[4]==1){
            $aObj=InstituteType::findOrfail($id);
            return view('institutesettings.institutetype.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aObj]);
        }else{
            return redirect('institutetype');
        }
    }
    public function update(Request $request, $id)
    {
        $aBean=InstituteType::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->update();
        return redirect('institutetype');
    }
}
