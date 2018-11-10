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
        $accessStatus=Role::getAccessStatus();
    	$result=InstituteType::all();
        return view('institutesettings.institutetype.index',['result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            return view('institutesettings.institutetype.create');
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
            $aObj=InstituteType::findOrfail($id);
            return view('institutesettings.institutetype.edit',['bean'=>$aObj]);
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
