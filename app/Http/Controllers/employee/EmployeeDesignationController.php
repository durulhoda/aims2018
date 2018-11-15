<?php

namespace App\Http\Controllers\employee;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\EmployeeDesignation;
class EmployeeDesignationController extends Controller
{
	public function index(){
		if(Role::checkAdmin()==1){
			$sidebarMenu=Role::getAllMenu();
		}else{
			$sidebarMenu=Role::getMenu();
		}
		$accessStatus=Role::getAccessStatus();
		$result=EmployeeDesignation::all();
		return view('employeesettings.designation.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if(Role::checkAdmin()==1){
			$sidebarMenu=Role::getAllMenu();
		}else{
			$sidebarMenu=Role::getMenu();
		}
		if($accessStatus[2]==1){
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
		$accessStatus=Role::getAccessStatus();
		if(Role::checkAdmin()==1){
			$sidebarMenu=Role::getAllMenu();
		}else{
			$sidebarMenu=Role::getMenu();
		}
		if($accessStatus[4]==1){
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
