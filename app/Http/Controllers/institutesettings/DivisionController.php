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
        $dmenu=Role::getMenu();
    	$result=Division::all();
        $accessStatus=Role::getAccessStatus();
        return view('institutesettings.division.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            $dmenu=Role::getMenu();
            return view('institutesettings.division.create',['dmenu'=>$dmenu]);
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
         $dmenu=Role::getMenu();
         $aBean=Division::findOrfail($id);
        return view('institutesettings.division.edit',['dmenu'=>$dmenu,'bean'=>$aBean]);
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
