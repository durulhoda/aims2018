<?php

namespace App\Http\Controllers\employee;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\Department;
class DepartmentController extends Controller
{
	public function index(){
		$sidebarMenu=Role::getMenu();
		$accessStatus=Role::getAccessStatus();
		$result=Department::all();
		return view('employeesettings.department.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			$sidebarMenu=Role::getMenu();
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
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[4]==1){
			$sidebarMenu=Role::getMenu();
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
