<?php

namespace App\Http\Controllers\employee;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\EmployeeType;
class EmployeeTypeController extends Controller
{
	public function index(){
		if(Role::checkAdmin()==1){
			$sidebarMenu=Role::getAllMenu();
		}else{
			$sidebarMenu=Role::getMenu();
		}
		$accessStatus=Role::getAccessStatus();
		$result=EmployeeType::all();
		return view('employeesettings.employeeType.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if(Role::checkAdmin()==1){
			$sidebarMenu=Role::getAllMenu();
		}else{
			$sidebarMenu=Role::getMenu();
		}
		if($accessStatus[2]==1){
			return view('employeesettings.employeeType.create',['sidebarMenu'=>$sidebarMenu]);
		}else{
			return redirect('employeeType');
		}
		
	}
	public function store(Request $request){
		$aBean=new EmployeeType();
		$aBean->name=$request->name;
		$aBean->save();
		return redirect('employeeType');
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
			$aBean=EmployeeType::findOrfail($id);
			return view('employeesettings.employeeType.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
		}else{
			return redirect('employeeType');
		}
		
	}
	public function update(Request $request, $id)
	{
		$aBean=EmployeeType::findOrfail($id);
		$aBean->name=$request->name;
		$aBean->update();
		return redirect('employeeType');
	}
}
