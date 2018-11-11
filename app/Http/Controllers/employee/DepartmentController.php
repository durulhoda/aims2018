<?php

namespace App\Http\Controllers\employee;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\Department;
class DepartmentController extends Controller
{
	public function index(){
		$dmenu=Role::getMenu();
		$accessStatus=Role::getAccessStatus();
		$result=Department::all();
		return view('employeesettings.department.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			$dmenu=Role::getMenu();
			return view('employeesettings.department.create',['dmenu'=>$dmenu]);
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
			$dmenu=Role::getMenu();
			$aBean=Department::findOrfail($id);
			return view('employeesettings.department.edit',['dmenu'=>$dmenu,'bean'=>$aBean]);
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
