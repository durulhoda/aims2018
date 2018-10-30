<?php

namespace App\Http\Controllers\institutesettings;
use App\institutesettings\InstituteCatagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteCategoryController extends Controller
{
    public function index()
    {
        $result=InstituteCatagory::all();
        return view('institutesettings.institutecategory.index',['result'=>$result]);
    }
    public function create(){
        return view('institutesettings.institutecategory.create');
    }
    public function store(Request $request){
        $aObj=new InstituteCatagory();
        $aObj->name=$request->name;
        $aObj->save();
        return redirect('institutecategory');
    }
    public function edit($id)
    {
         $aObj=InstituteCatagory::findOrfail($id);
         return view('institutesettings.institutecategory.edit',['bean'=>$aObj]);
    }
     public function update(Request $request, $id)
    {
        $aObj=InstituteCatagory::findOrfail($id);
        $aObj->name=$request->name;
        $aObj->update();
        return redirect('institutecategory');
    }
}
