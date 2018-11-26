<?php

namespace App\Http\Controllers\institutesettings;
use App\role\RoleHelper;
use App\institutesettings\InstituteSubCatagory;
use App\institutesettings\InstituteCatagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteSubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
      $rh=new RoleHelper();
    $menuid=$rh->getMenuId('institutesubcategory');
    $hasMenu=$rh->hasMenu($menuid);
    if($hasMenu==false){
        return redirect('error');
    }
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
    $result=\DB::table('institutesubcategory')
    ->join('institutecategory','institutesubcategory.categoryid','=','institutecategory.id')
    ->select('institutesubcategory.*','institutecategory.name As categoryName')
    ->get();
    return view('institutesettings.institutesubcategory.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$result]);
}
public function create(){
   $rh=new RoleHelper();
    $menuid=$rh->getMenuId('institutesubcategory');
    $hasMenu=$rh->hasMenu($menuid);
    if($hasMenu==false){
        return redirect('error');
    }
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
    if($permission[2]==1){
     $categoriesList=InstituteCatagory::all();
     return view('institutesettings.institutesubcategory.create',['sidebarMenu'=>$sidebarMenu,'categories'=>$categoriesList]);
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
   $rh=new RoleHelper();
    $menuid=$rh->getMenuId('institutesubcategory');
    $hasMenu=$rh->hasMenu($menuid);
    if($hasMenu==false){
        return redirect('error');
    }
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
   if($permission[4]==1){
       $categories=InstituteCatagory::all();
       $aBean=InstituteSubCatagory::findOrfail($id);
       return view('institutesettings.institutesubcategory.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'categories'=>$categories]);
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
