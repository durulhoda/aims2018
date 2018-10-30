<?php

namespace App\Http\Controllers\settings;

use App\settings\Medium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class MediumController extends Controller
{
    public function index()
    {
        $result=Medium::all();
        return view('settings.medium.index',['result'=>$result]);
    }
    public function create()
    {
         return view('settings.medium.create');
    }
    public function store(Request $request)
    {
        $aObj=new Medium();
        $aObj->name=$request->name;
        $aObj->save();
        return redirect('medium');
    }
    public function edit($id)
    {
         $aObj=Medium::findOrfail($id);
         return view('settings.medium.edit',['bean'=>$aObj]);
    }

    public function update(Request $request, $id)
    {
        $aObj=Medium::findOrfail($id);
        $aObj->name=$request->name;
        $aObj->update();
        return redirect('medium');
    }
}
