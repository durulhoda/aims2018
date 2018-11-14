<?php

namespace App\Http\Controllers\institutesettings;

use App\institutesettings\Division;
use App\Role;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class DivisionController extends Controller
{

public function __construct()
{
    $this->middleware('auth');
}
public function index()
{
    $userid = Auth::user()->id;
    $sidebarMenu=Role::getMenu();
    $result=Division::all();
    $accessStatus=Role::getAccessStatus();
    return view('institutesettings.division.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
}
public function create(){
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[2]==1){
        $sidebarMenu=Role::getMenu();
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
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[4]==1){
       $sidebarMenu=Role::getMenu();
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
