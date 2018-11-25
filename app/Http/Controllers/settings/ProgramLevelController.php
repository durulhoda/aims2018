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
        $accessStatus=Role::getAccessStatus();
        $result=ProgramLevel::all();
        return view('settings.programLevle.index',compact('result','accessStatus'));
    }
    public function create()
    {
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
             return view('settings.programLevle.create');
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
        $accessStatus=Role::getAccessStatus();
        $aBean=ProgramLevel::findOrfail($id);
        if($accessStatus[4]==1){
            return view('settings.programLevle.edit',['bean'=>$aBean]);
        }else{
            return redirect('programLevel');
        }
       
    }

    public function update(Request $request,$id)
    {
        $aBean = aBean::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->update();
        return redirect('programLevel');
    }
}
