<?php

namespace App\Http\Controllers\institutesettings;
use App\Role;
use App\institutesettings\InstituteCatagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteCategoryController extends Controller
{
    public function index()
    {
        $accessStatus=Role::getAccessStatus();
        $result=InstituteCatagory::all();
        return view('institutesettings.institutecategory.index',['result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            return view('institutesettings.institutecategory.create');
        }else{
            return redirect('institutecategory');
        }
        
    }
    public function store(Request $request){
        $aBean=new InstituteCatagory();
        $aBean->name=$request->name;
        $aBean->save();
        return redirect('institutecategory');
    }
    public function edit($id)
    {
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[4]==1){
            $aBean=InstituteCatagory::findOrfail($id);
            return view('institutesettings.institutecategory.edit',['bean'=>$aBean]);
        }else{
            return redirect('institutecategory');
        }
         
    }
     public function update(Request $request, $id)
    {
        $aBean=InstituteCatagory::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->update();
        return redirect('institutecategory');
    }
}
