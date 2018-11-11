<?php

namespace App\Http\Controllers\institutesettings;
use App\Role;
use App\institutesettings\InstituteSubCatagory;
use App\institutesettings\InstituteCatagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteSubCategoryController extends Controller
{
   public function index()
    {
         $dmenu=Role::getMenu();
        $accessStatus=Role::getAccessStatus();
        $result=\DB::table('institutesubcategory')
        ->join('institutecategory','institutesubcategory.categoryid','=','institutecategory.id')
        ->select('institutesubcategory.*','institutecategory.name As categoryName')
        ->get();
        return view('institutesettings.institutesubcategory.index',['dmenu'=>$dmenu,'result'=>$result]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
             $dmenu=Role::getMenu();
           $categories=InstituteCatagory::all();
           return view('institutesettings.institutesubcategory.create',['dmenu'=>$dmenu,'categories'=>$categories]);
        }else{
           return redirect('institutesubcategory'); 
        }
       
    }
    public function store(Request $request){
        $aBean=new InstituteSubCatagory();
        $aBean->name=$request->name;
        $aBean->categoryid=$request->categoryid;
        $aBean->save();
        return redirect('institutesubcategory');
    }
    public function edit($id)
    {
         $accessStatus=Role::getAccessStatus();
         if($accessStatus[4]==1){
             $dmenu=Role::getMenu();
            $categories=InstituteCatagory::all();
            $aBean=InstituteSubCatagory::findOrfail($id);
            return view('institutesettings.institutesubcategory.edit',['dmenu'=>$dmenu,'bean'=>$aBean,'categories'=>$categories]);
         }else{
            return redirect('institutesubcategory');
         }
         
    }
     public function update(Request $request, $id)
    {
        $aBean=InstituteSubCatagory::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->categoryid=$request->categoryid;
        $aBean->update();
        return redirect('institutesubcategory');
    }
}
