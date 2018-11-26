<?php

namespace App\Http\Controllers\employee;
use App\role\RoleHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\Department;
class DepartmentController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}
	public function index(){
		$rh=new RoleHelper();
        $menuid=$rh->getMenuId('department');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
              return redirect('error');
         }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
		$result=Department::all();
		return view('employeesettings.department.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
	}
	public function create(){
		$rh=new RoleHelper();
        $menuid=$rh->getMenuId('department');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
              return redirect('error');
         }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
		if($permission[2]==1){
			return view('employeesettings.department.create',['sidebarMenu'=>$sidebarMenu]);
		}else{
			return redirect('department');
		}
		
	}
	public function store(Request $request){
		$aBean=new Department();
		$aBean->name=$request->name;
		$aBean->save();
		return redirect('department');
	}
	public function edit($id)
	{
		$rh=new RoleHelper();
        $menuid=$rh->getMenuId('department');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
              return redirect('error');
         }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
		if($permission[4]==1){
			$aBean=Department::findOrfail($id);
			return view('employeesettings.department.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
		}else{
			return redirect('department');
		}
		
	}
	public function update(Request $request, $id)
	{
		$aBean=Department::findOrfail($id);
		$aBean->name=$request->name;
		$aBean->update();
		return redirect('department');
	}
}
