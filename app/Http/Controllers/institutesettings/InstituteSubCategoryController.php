<?php

namespace App\Http\Controllers\institutesettings;
use App\institutesettings\InstituteSubCatagory;
use App\institutesettings\InstituteCatagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteSubCategoryController extends Controller
{
   public function index()
    {
        $result=\DB::table('institutesubcategory')
        ->join('institutecategory','institutesubcategory.categoryid','=','institutecategory.id')
        ->select('institutesubcategory.*','institutecategory.name As categoryName')
        ->get();
        return view('institutesettings.institutesubcategory.index',['result'=>$result]);
    }
    public function create(){
        $categories=InstituteCatagory::all();
        return view('institutesettings.institutesubcategory.create',['categories'=>$categories]);
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
         $categories=InstituteCatagory::all();
         $aBean=InstituteSubCatagory::findOrfail($id);
         return view('institutesettings.institutesubcategory.edit',['bean'=>$aBean,'categories'=>$categories]);
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
