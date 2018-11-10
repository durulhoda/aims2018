<?php

namespace App\Http\Controllers\settings;

use App\Role;
use App\settings\Medium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class MediumController extends Controller
{
    public function index()
    {
        $accessStatus=Role::getAccessStatus();
        $result=Medium::all();
        return view('settings.medium.index',['result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create()
    {
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
         return view('settings.medium.create');
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
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[4]==1){
         $aBean=Medium::findOrfail($id);
         return view('settings.medium.edit',['bean'=>$aBean]);
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
