<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\Department;
class DepartmentController extends Controller
{
     public function index(){
		$result=Department::all();
		 return view('employeesettings.department.index',['result'=>$result]);
	}
	public function create(){
		return view('employeesettings.department.create');
	}
	public function store(Request $request){
		$aBean=new Department();
		$aBean->name=$request->name;
		$aBean->save();
		return redirect('department');
	}
	public function edit($id)
	{
		$aBean=Department::findOrfail($id);
		return view('employeesettings.department.edit',['bean'=>$aBean]);
	}
	 public function update(Request $request, $id)
    {
    	$aBean=Department::findOrfail($id);
    	$aBean->name=$request->name;
		$aBean->update();
		return redirect('department');
    }
}
