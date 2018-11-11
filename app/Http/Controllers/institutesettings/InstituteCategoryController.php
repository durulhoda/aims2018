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
        $dmenu=Role::getMenu();
        $accessStatus=Role::getAccessStatus();
        $result=InstituteCatagory::all();
        return view('institutesettings.institutecategory.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            $dmenu=Role::getMenu();
            return view('institutesettings.institutecategory.create',['dmenu'=>$dmenu]);
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
            $dmenu=Role::getMenu();
            $aBean=InstituteCatagory::findOrfail($id);
            return view('institutesettings.institutecategory.edit',['dmenu'=>$dmenu,'bean'=>$aBean]);
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
