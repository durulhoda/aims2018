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
        $aBean=new InstituteCatagory();
        $aBean->name=$request->name;
        $aBean->save();
        return redirect('institutecategory');
    }
    public function edit($id)
    {
         $aBean=InstituteCatagory::findOrfail($id);
         return view('institutesettings.institutecategory.edit',['bean'=>$aBean]);
    }
     public function update(Request $request, $id)
    {
        $aBean=InstituteCatagory::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->update();
        return redirect('institutecategory');
    }
}
