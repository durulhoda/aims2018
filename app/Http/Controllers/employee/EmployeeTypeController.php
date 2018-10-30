<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\EmployeeType;
class EmployeeTypeController extends Controller
{
    public function index(){
		$result=EmployeeType::all();
		 return view('employeeSettings.employeeType.index',['result'=>$result]);
	}
	public function create(){
		return view('employeeSettings.employeeType.create');
	}
	public function store(Request $request){
		$aObj=new EmployeeType();
		$aObj->name=$request->name;
		$aObj->save();
		return redirect('employeeType');
	}
	public function edit($id)
	{
		$aObj=EmployeeType::findOrfail($id);
		return view('employeeSettings.employeeType.edit',['bean'=>$aObj]);
	}
	 public function update(Request $request, $id)
    {
    	$aObj=EmployeeType::findOrfail($id);
    	$aObj->name=$request->name;
		$aObj->update();
		return redirect('employeeType');
    }
}
