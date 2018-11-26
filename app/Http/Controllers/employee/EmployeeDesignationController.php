<?php

namespace App\Http\Controllers\employee;
use App\role\RoleHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\EmployeeDesignation;
class EmployeeDesignationController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}
	public function index(){
	$rh=new RoleHelper();
    $menuid=$rh->getMenuId('employee');
    $hasMenu=$rh->hasMenu($menuid);
    if($hasMenu==false){
         return redirect('error');
      }
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
		$result=EmployeeDesignation::all();
		return view('employeesettings.designation.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
	}
	public function create(){
		$rh=new RoleHelper();
	    $menuid=$rh->getMenuId('employee');
	    $hasMenu=$rh->hasMenu($menuid);
	    if($hasMenu==false){
	         return redirect('error');
	      }
	    $sidebarMenu=$rh->getMenu();
	    $permission=$rh->getPermission($menuid);
		if($permission[2]==1){
			return view('employeesettings.designation.create',['sidebarMenu'=>$sidebarMenu]);
		}else{
			return redirect('employeedesignation');
		}
		
	}
	public function store(Request $request){
		$aBean=new EmployeeDesignation();
		$aBean->name=$request->name;
		$aBean->save();
		return redirect('employeedesignation');
	}
	public function edit($id)
	{
		$rh=new RoleHelper();
	    $menuid=$rh->getMenuId('employee');
	    $hasMenu=$rh->hasMenu($menuid);
	    if($hasMenu==false){
	         return redirect('error');
	      }
	    $sidebarMenu=$rh->getMenu();
	    $permission=$rh->getPermission($menuid);
		if($permission[4]==1){
			$aBean=EmployeeDesignation::findOrfail($id);
			return view('employeesettings.designation.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
		}else{
			return redirect('employeedesignation');
		}
		
	}
	public function update(Request $request, $id)
	{
		$aBean=EmployeeDesignation::findOrfail($id);
		$aBean->name=$request->name;
		$aBean->update();
		return redirect('employeedesignation');
	}
}
