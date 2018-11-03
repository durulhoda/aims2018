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
        $aBean=InstituteType::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->update();
        return redirect('institutetype');
    }
}
