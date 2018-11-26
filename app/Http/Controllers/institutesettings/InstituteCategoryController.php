<?php

namespace App\Http\Controllers\institutesettings;
use App\institutesettings\InstituteCatagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
class InstituteCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('institutecategory');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $result=InstituteCatagory::all();
        return view('institutesettings.institutecategory.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
    }
    public function create(){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('institutecategory');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[2]==1){
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
         $rh=new RoleHelper();
        $menuid=$rh->getMenuId('institutecategory');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[4]==1){
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
