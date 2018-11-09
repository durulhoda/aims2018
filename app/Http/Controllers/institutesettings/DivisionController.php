<?php

namespace App\Http\Controllers\institutesettings;

use App\institutesettings\Division;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function index()
    {
    	$result=Division::all();
        $accessStatus=Role::getAccessStatus();
        return view('institutesettings.division.index',['result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            return view('institutesettings.division.create');
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
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[4]==1){
         $aBean=Division::findOrfail($id);
        return view('institutesettings.division.edit',['bean'=>$aBean]);
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
