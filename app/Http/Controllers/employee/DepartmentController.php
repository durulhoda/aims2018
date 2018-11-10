<?php

namespace App\Http\Controllers\employee;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\Department;
class DepartmentController extends Controller
{
	public function index(){
		$accessStatus=Role::getAccessStatus();
		$result=Department::all();
		return view('employeesettings.department.index',['result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			return view('employeesettings.department.create');
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
			$aBean=Department::findOrfail($id);
			return view('employeesettings.department.edit',['bean'=>$aBean]);
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
