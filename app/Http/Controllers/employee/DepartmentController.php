<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\Department;
class DepartmentController extends Controller
{
     public function index(){
		$result=Department::all();
		 return view('employeeSettings.department.index',['result'=>$result]);
	}
	public function create(){
		return view('employeeSettings.department.create');
	}
	public function store(Request $request){
		$aObj=new Department();
		$aObj->name=$request->name;
		$aObj->save();
		return redirect('department');
	}
	public function edit($id)
	{
		$aObj=Department::findOrfail($id);
		return view('employeeSettings.department.edit',['bean'=>$aObj]);
	}
	 public function update(Request $request, $id)
    {
    	$aObj=Department::findOrfail($id);
    	$aObj->name=$request->name;
		$aObj->update();
		return redirect('department');
    }
}
