<?php

namespace App\Http\Controllers\institutesettings;
use App\institutesettings\InstituteType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteTypeController extends Controller
{
    public function index()
    {
    	$result=InstituteType::all();
        return view('institutesettings.institutetype.index',['result'=>$result]);
    }
    public function create(){
    	return view('institutesettings.institutetype.create');
    }
    public function store(Request $request){
        $aObj=new InstituteType();
        $aObj->name=$request->name;
        $aObj->save();
        return redirect('institutetype');
    }
    public function edit($id)
    {
         $aObj=InstituteType::findOrfail($id);
         return view('institutesettings.institutetype.edit',['bean'=>$aObj]);
    }
     public function update(Request $request, $id)
    {
        $aObj=InstituteType::findOrfail($id);
        $aObj->name=$request->name;
        $aObj->update();
        return redirect('institutetype');
    }
}
