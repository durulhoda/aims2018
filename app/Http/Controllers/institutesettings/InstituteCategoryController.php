<?php

namespace App\Http\Controllers\institutesettings;
use App\Role;
use App\institutesettings\InstituteCatagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteCategoryController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function index()
    {
        $sidebarMenu=Role::getMenu();
        $accessStatus=Role::getAccessStatus();
        $result=InstituteCatagory::all();
        return view('institutesettings.institutecategory.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            $sidebarMenu=Role::getMenu();
            return view('institutesettings.institutecategory.create',['sidebarMenu'=>$sidebarMenu]);
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
            $sidebarMenu=Role::getMenu();
            $aBean=InstituteCatagory::findOrfail($id);
            return view('institutesettings.institutecategory.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
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
