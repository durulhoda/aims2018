<?php

namespace App\Http\Controllers\employee;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\EmployeeDesignation;
class EmployeeDesignationController extends Controller
{
	public function index(){
		$dmenu=Role::getMenu();
		$accessStatus=Role::getAccessStatus();
		$result=EmployeeDesignation::all();
		return view('employeesettings.designation.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			$dmenu=Role::getMenu();
			return view('employeesettings.designation.create',['dmenu'=>$dmenu]);
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
		if($accessStatus[4]==1){
			$dmenu=Role::getMenu();
			$aBean=EmployeeDesignation::findOrfail($id);
			return view('employeesettings.designation.edit',['dmenu'=>$dmenu,'bean'=>$aBean]);
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
