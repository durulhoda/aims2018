<?php

namespace App\Http\Controllers\employee;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\EmployeeType;
class EmployeeTypeController extends Controller
{
	public function index(){
		$dmenu=Role::getMenu();
		$accessStatus=Role::getAccessStatus();
		$result=EmployeeType::all();
		return view('employeesettings.employeeType.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
	}
	public function create(){
		$accessStatus=Role::getAccessStatus();
		if($accessStatus[2]==1){
			$dmenu=Role::getMenu();
			return view('employeesettings.employeeType.create',['dmenu'=>$dmenu]);
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
		if($accessStatus[4]==1){
			$dmenu=Role::getMenu();
			$aBean=EmployeeType::findOrfail($id);
			return view('employeesettings.employeeType.edit',['dmenu'=>$dmenu,'bean'=>$aBean]);
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
