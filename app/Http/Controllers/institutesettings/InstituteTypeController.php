<?php

namespace App\Http\Controllers\institutesettings;
use App\Role;
use App\institutesettings\InstituteType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteTypeController extends Controller
{
    public function index()
    {
         $dmenu=Role::getMenu();
        $accessStatus=Role::getAccessStatus();
    	$result=InstituteType::all();
        return view('institutesettings.institutetype.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            $dmenu=Role::getMenu();
            return view('institutesettings.institutetype.create',['dmenu'=>$dmenu]);
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
        if($accessStatus[4]==1){
             $dmenu=Role::getMenu();
            $aObj=InstituteType::findOrfail($id);
            return view('institutesettings.institutetype.edit',['dmenu'=>$dmenu,'bean'=>$aObj]);
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
