<?php

namespace App\Http\Controllers\institutesettings;

use App\institutesettings\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function index()
    {
    	$result=Division::all();
        return view('institutesettings.division.index',['result'=>$result]);
    }
    public function create(){
    	return view('institutesettings.division.create');
    }
    public function store(Request $request){
        $aObj=new Division();
        $aObj->name=$request->name;
        $aObj->save();
        return redirect('division');
    }
    public function edit($id)
    {
         $aObj=Division::findOrfail($id);
         return view('institutesettings.division.edit',['bean'=>$aObj]);
    }
     public function update(Request $request, $id)
    {
        $aObj=Division::findOrfail($id);
        $aObj->name=$request->name;
        $aObj->update();
        return redirect('division');
    }
}
