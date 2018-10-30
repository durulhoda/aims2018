<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use App\employee\EmployeeDesignation;
class EmployeeDesignationController extends Controller
{
    public function index(){
		$result=EmployeeDesignation::all();
		 return view('employeeSettings.employeeDesignation.index',['result'=>$result]);
	}
	public function create(){
		return view('employeeSettings.employeeDesignation.create');
	}
	public function store(Request $request){
		$aObj=new EmployeeDesignation();
		$aObj->name=$request->name;
		$aObj->save();
		return redirect('employeedesignation');
	}
	public function edit($id)
	{
		$aObj=EmployeeDesignation::findOrfail($id);
		return view('employeeSettings.employeeDesignation.edit',['bean'=>$aObj]);
	}
	 public function update(Request $request, $id)
    {
    	$aObj=EmployeeDesignation::findOrfail($id);
    	$aObj->name=$request->name;
		$aObj->update();
		return redirect('employeedesignation');
    }
}
